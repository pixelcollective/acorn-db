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
use Sofa\Eloquence\ServiceProvider as Eloquence;
use Roots\Acorn\ServiceProvider;

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

        $this->bindDatabase();

        $this->registerCommandsFromDir(__DIR__, '/../Console/Commands/Migrate');
        $this->registerCommandsFromDir(__DIR__, '/../Console/Commands/Seeds');
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

        $this->appDir = substr(strtolower($this->app->getNamespace()), 0, -1);

        $this->publishes([
            __DIR__ . '/../config/database.php' => config_path('database.php'),
            __DIR__ . '/../Models'              => base_path("{$this->appDir}/Models"),
        ]);
    }

    /**
     * Bind database to container
     *
     * @return void
     */
    protected function bindDatabase()
    {
        Model::clearBootedModels();

        $this->app->singleton('db.factory', function () {
            return new ConnectionFactory($this->app);
        });

        $this->app->singleton('db', function () {
            return new DatabaseManager($this->app, $this->app['db.factory']);
        });

        $this->app->bind('db.connection', function () {
            return $this->app['db']->connection();
        });

        $this->app->bind('db.schema', function () {
            return $this->app['db']->connection()->getSchemaBuilder();
        });

        $this->app->singleton(EntityResolver::class, function () {
            return new QueueEntityResolver();
        });

        $this->app->bindIf(
            MigrationRepositoryInterface::class,
            'migration.repository'
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
            $this->commands->push("{$namespace}\\{$className}");
        });

        $this->commands->each(function ($command) {
            $this->commands($command);
        });
    }
}
