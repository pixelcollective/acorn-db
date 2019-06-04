<?php

namespace App\Providers;

use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Queue\EntityResolver;
use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Database\Eloquent\QueueEntityResolver;

use \Roots\Acorn\ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider
{
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
            return new QueueEntityResolver;
        });
    }

    public function boot()
    {
        Model::setConnectionResolver($this->app['db']);
        Model::setEventDispatcher($this->app['events']);
    }
}
