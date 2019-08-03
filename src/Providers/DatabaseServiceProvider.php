<?php

namespace TinyPixel\Acorn\Database\Providers;

use function Roots\base_path;
use function Roots\config_path;
use Faker\Factory;
Use Illuminate\Support\Collection;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\QueueEntityResolver;
use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Contracts\Queue\EntityResolver;
use Illuminate\Database\Migrations\MigrationRepositoryInterface;
use Illuminate\Database\ConnectionResolverInterface;
use Sofa\Eloquence\ServiceProvider as Eloquence;
use Roots\Acorn\ServiceProvider;

/**
 * Acorn DB service provider
 *
 * @author  Kelly Mears <kelly@tinypixel.dev>
 * @license MIT
 * @since   1.0.0
 *
 * @package    wordpress
 * @subpackage Acorn\Database
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

        $this->app->bindIf(
            ConnectionResolverInterface::class,
            'db'
        );

        // The connection factory is used to create the actual connection instances on
        // the database. We will inject the factory into the manager so that it may
        // make the connections while they are actually needed and not of before.
        $this->app->singleton('db.factory', function ($app) {
            return new ConnectionFactory($app);
        });

        // The database manager is used to resolve various connections, since multiple
        // connections might be managed. It also implements the connection resolver
        // interface which may be used by other components requiring connections.
        $this->app->singleton('db', function ($app) {
            return new DatabaseManager($app, $app['db.factory']);
        });

        $this->app->bind('db.connection', function ($app) {
            return $app['db']->connection();
        });

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
            __DIR__ . '/../../config/database.php' => config_path('database.php'),
            __DIR__ . '/../../Models' => base_path($appDir . '/Models'),
        ], 'Acorn Database');

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
