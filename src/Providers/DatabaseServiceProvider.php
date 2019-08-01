<?php

namespace TinyPixel\Acorn\Database\Providers;

use TinyPixel\Acorn\Support\Utility;
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
use Faker\Factory;

use function Roots\base_path;
use function Roots\config_path;

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
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->namespace = __NAMESPACE__;

        Model::clearBootedModels();

        $this->bindInterfaces();

        $this->registerConnectionServices();

        $this->registerEloquentFactory();

        $this->registerQueueableEntityResolver();
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

        $this->registerPublishables();

        $this->registerSeedersFrom(base_path('database/seeds'));
    }

    /**
     * Register the primary database bindings.
     *
     * @return void
     */
    protected function registerConnectionServices()
    {
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
    }

    /**
     * Register the Eloquent factory instance in the container.
     *
     * @return void
     */
    protected function registerEloquentFactory()
    {
        $this->app->singleton(FakerGenerator::class, function ($app) {
            return FakerFactory::create($app['config']->get('app.faker_locale', 'en_US'));
        });

        $this->app->singleton(EloquentFactory::class, function ($app) {
            return EloquentFactory::construct(
                $app->make(FakerGenerator::class), $this->app->databasePath('factories')
            );
        });
    }

    /**
     * Register the queueable entity resolver implementation.
     *
     * @return void
     */
    protected function registerQueueableEntityResolver()
    {
        $this->app->singleton(EntityResolver::class, function () {
            return new QueueEntityResolver;
        });
    }

    /**
     * Bind database to container
     *
     * @return void
     */
    protected function bindInterfaces()
    {
        $this->app->bindIf(
            MigrationRepositoryInterface::class,
            'migration.repository'
        );

        $this->app->bindIf(
            ConnectionResolverInterface::class,
            'db'
        );
    }

    /**
     * Register commands from directory
     *
     * @param  string $base
     * @param  string $dir
     * @return void
     */
    protected function registerCommandsFromDir(string $base, string $dir)
    {
        $this->commands = Collection::make();

        $definitions = Collection::make(glob("{$base}/{$dir}/*.php"));

        $definitions->each(function ($file) use ($dir) {
            $namespace = $this->namespace . Utility::pathToNamespace($dir);
            $className = basename($file, '.php');
            $namespace = str_replace('Providers\\', '', $namespace);

            $this->commands->push("{$namespace}\\{$className}");
        });

        $this->commands->each(function ($command) {
            $this->commands($command);
        });
    }

    /**
     * Registers publishables
     *
     * @return void
     */
    protected function registerPublishables()
    {
        $this->appDir = substr(strtolower($this->app->getNamespace()), 0, -1);

        $this->publishes([
            __DIR__ . '/../config/database.php' => config_path('database.php'),
            __DIR__ . '/../Models'              => base_path("{$this->appDir}/Models"),
        ]);

        $this->registerCommandsFromDir(__DIR__ . '/..', '/Console/Commands/Migrate');
        $this->registerCommandsFromDir(__DIR__ . '/..', '/Console/Commands/Seeds');
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
