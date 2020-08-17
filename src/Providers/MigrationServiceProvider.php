<?php
namespace AcornDB\Providers;

use Roots\Acorn\ServiceProvider;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Database\Migrations\DatabaseMigrationRepository;

/**
 * Migration service provider
 *
 * @author  Kelly Mears <kelly@tinypixel.dev>
 * @license MIT
 * @since   1.0.0
 *
 * @package    AcornDB
 * @subpackage Providers
 **/
class MigrationServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('migration.repository', function ($app) {
            return new DatabaseMigrationRepository($app['db'], $app['config']->get('database.migrations'));
        });

        $this->app->singleton('migrator', function ($app) {
            return new Migrator($app['migration.repository'], $app['db'], $app['files'], $app['events']);
        });

        $this->app->singleton('migration.creator', function ($app) {
            return new MigrationCreator($app['files'], '');
        });
    }

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        // --
    }
}
