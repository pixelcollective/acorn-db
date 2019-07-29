<?php

namespace TinyPixel\AcornModels;

use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\QueueEntityResolver;
use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Contracts\Queue\EntityResolver;
use Sofa\Eloquence\ServiceProvider as Eloquence;
use Illuminate\Database\Migrations\MigrationRepositoryInterface;

use \Roots\Acorn\ServiceProvider;
use function \Roots\base_path;
use function \Roots\config_path;

/**
 * Database service provider
 *
 * @author  Kelly Mears <kelly@tinypixel.dev>
 * @license MIT
 * @since   1.0.0
 *
 * @package    wordpress
 * @subpackage AcornDatabase
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

        $this->app->bindIf(MigrationRepositoryInterface::class, 'migration.repository');
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
            __DIR__ . "/../Console"             => base_path("$appDir/Console"),
            __DIR__ . '/../config/database.php' => config_path('database.php'),
            __DIR__ . '/../Models'              => base_path("{$appDir}/Models"),
        ]);
    }
}
