<?php

namespace AcornDB\Providers;

use Illuminate\Database\Migrations\Migrator;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Database\Migrations\DatabaseMigrationRepository;
use AcornDB\Console\Commands\Migrate\FreshCommand as MigrateFreshCommand;
use AcornDB\Console\Commands\Migrate\MakeCommand as MigrateMakeCommand;
use AcornDB\Console\Commands\Migrate\InstallCommand as MigrateInstallCommand;
use AcornDB\Console\Commands\Migrate\RefreshCommand as MigrateRefreshCommand;
use AcornDB\Console\Commands\Migrate\ResetCommand as MigrateResetCommand;
use AcornDB\Console\Commands\Migrate\RollbackCommand as MigrateRollbackCommand;
use AcornDB\Console\Commands\Migrate\StatusCommand as MigrateStatusCommand;
use Roots\Acorn\ServiceProvider;

/**
 * Migration service provider
 *
 * @author  Kelly Mears <kelly@tinypixel.dev>
 * @license MIT
 */
class MigrationServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Acorn commands
     *
     * @var array
     */
    public $commands = [
        MigrateInstallCommand::class,
        MigrateFreshCommand::class,
        MigrateRefreshCommand::class,
        MigrateMakeCommand::class,
        MigrateResetCommand::class,
        MigrateRollbackCommand::class,
        MigrateStatusCommand::class,
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRepository();

        $this->registerMigrator();

        $this->registerCreator();

        $this->commands($this->commands);
    }

    /**
     * Register the migration repository service.
     *
     * @return void
     */
    protected function registerRepository(): void
    {
        $this->app->singleton('migration.repository', function ($app) {
            $table = $app['config']['database.migrations_table'];

            return new DatabaseMigrationRepository($app['db'], $table);
        });
    }

    /**
     * Register the migrator service.
     *
     * @return void
     */
    protected function registerMigrator()
    {
        // The migrator is responsible for actually running and rollback the migration
        // files in the application. We'll pass in our database connection resolver
        // so the migrator can resolve any of these connections when it needs to.
        $this->app->singleton('migrator', function ($app) {
            $repository = $app['migration.repository'];

            return new Migrator($repository, $app['db'], $app['files'], $app['events']);
        });
    }

    /**
     * Register the migration creator.
     *
     * @return void
     */
    protected function registerCreator()
    {
        $this->app->singleton('migration.creator', function ($app) {
            $path = $app['config']['database.migrations_path'];

            return new MigrationCreator($app['files'], $path);
        });
    }
}
