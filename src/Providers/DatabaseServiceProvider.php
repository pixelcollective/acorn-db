<?php

namespace TinyPixel\Acorn\Database\Providers;

use function Roots\base_path;
use function Roots\config_path;
use Roots\Acorn\ServiceProvider;
use Faker\Factory;
use Sofa\Eloquence\ServiceProvider as Eloquence;
use Illuminate\Support\Collection;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\QueueEntityResolver;
use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Contracts\Queue\EntityResolver;
use Illuminate\Database\Migrations\MigrationRepositoryInterface;
use Illuminate\Database\ConnectionResolverInterface;

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
     * CLI Commands
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
     * Register primary Eloquent service and associated features
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
            return QueueEntityResolver::class;
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
            __DIR__ . '/../../Models'              => base_path($appDir . '/Models'),
            __DIR__ . '/../../config/database.php' => config_path('database.php'),
        ], 'Acorn Database');

        $this->commands($this->commands);
    }

    /**
     * Register database seeders
     *
     * @param  string $path
     * @return void
     */
    protected function registerSeedersFrom(string $path)
    {
        foreach (glob("$path/*.php") as $filename) {
            include $filename;
        }
    }
}
