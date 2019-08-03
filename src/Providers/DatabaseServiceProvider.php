<?php

namespace TinyPixel\Acorn\Database\Providers;

use function Roots\base_path;
use function Roots\config_path;
use Faker\Factory;
Use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\QueueEntityResolver;
use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Contracts\Queue\EntityResolver;
use Illuminate\Database\Migrations\MigrationRepositoryInterface;
use Illuminate\Database\ConnectionResolverInterface;
use Sofa\Eloquence\ServiceProvider as Eloquence;
use Roots\Acorn\ServiceProvider;

/**
 * Database service provider
 *
 * @author  Kelly Mears <kelly@tinypixel.dev>
 * @license MIT
 * @since   1.0.0
 *
 * @package    wordpress
 * @subpackage Acorn\Models
 */
class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Acorn Commands
     *
     * @var array
     */
    public $commands = [
        'TinyPixel\Acorn\Database\Console\Commands\Migrate\InstallCommand',
        'TinyPixel\Acorn\Database\Console\Commands\Migrate\MakeCommand',
        'TinyPixel\Acorn\Database\Console\Commands\Migrate\MigrateCommand',
        'TinyPixel\Acorn\Database\Console\Commands\Migrate\RefreshCommand',
        'TinyPixel\Acorn\Database\Console\Commands\Migrate\ResetCommand',
        'TinyPixel\Acorn\Database\Console\Commands\Migrate\RollbackCommand',
        'TinyPixel\Acorn\Database\Console\Commands\Migrate\StatusCommand',
        'TinyPixel\Acorn\Database\Console\Commands\Seeds\SeedCommand',
        'TinyPixel\Acorn\Database\Console\Commands\Seeds\SeederMakeCommand',
    ];

   /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Model::clearBootedModels();

        $this->app->bindIf(
            MigrationRepositoryInterface::class,
            'migration.repository'
        );

        $this->app->singleton(FakerGenerator::class, function ($app) {
            return FakerFactory::create($app['config']->get('app.faker_locale', 'en_US'));
        });

        $this->app->singleton(EloquentFactory::class, function ($app) {
            return EloquentFactory::construct(
                $app->make(FakerGenerator::class),
                $this->app->databasePath('factories')
            );
        });

        $this->app->singleton(EntityResolver::class, function () {
            return new QueueEntityResolver;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::setConnectionResolver($this->app['db']);

        Model::setEventDispatcher($this->app['events']);

        $appDir = substr(strtolower($this->app->getNamespace()), 0, -1);

        $this->publishes([
            __DIR__ . '/../Models' => base_path($appDir . '/Models'),
        ]);

        $this->commands($this->commands);
    }

    /**
     * Register seeders
     *
     * @return void
     */
   protected function registerSeedersFrom($path)
    {
        foreach (glob("$path/*.php") as $filename)
        {
            include $filename;
        }
    }
}
