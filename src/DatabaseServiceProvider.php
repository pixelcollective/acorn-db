<?php

namespace TinyPixel\Models\Providers;

use Illuminate\Database\{
    DatabaseManager,
    Eloquent\Model,
    Eloquent\QueueEntityResolver,
    Connectors\ConnectionFactory,
};

use Illuminate\Contracts\Queue\EntityResolver;
use \Roots\Acorn\ServiceProvider;

use function \Roots\config_path;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . "/config/database.php" => config_path('database.php'),
        ]);

        Model::setConnectionResolver($this->app['db']);
        Model::setEventDispatcher($this->app['events']);
    }
}
