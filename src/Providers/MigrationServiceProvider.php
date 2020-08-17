<?php

namespace AcornDB\Providers;

use Illuminate\Database\Migrations\Migrator;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Database\Migrations\DatabaseMigrationRepository;
use AcornDB\Console\Commands\Migrate\FreshCommand as FreshCommand;
use AcornDB\Console\Commands\Migrate\MakeCommand as MakeCommand;
use AcornDB\Console\Commands\Migrate\MigrateCommand as MigrateCommand;
use AcornDB\Console\Commands\Migrate\InstallCommand as InstallCommand;
use AcornDB\Console\Commands\Migrate\RefreshCommand as RefreshCommand;
use AcornDB\Console\Commands\Migrate\ResetCommand as ResetCommand;
use AcornDB\Console\Commands\Migrate\RollbackCommand as RollbackCommand;
use AcornDB\Console\Commands\Migrate\StatusCommand as StatusCommand;
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
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->when(MigrationCreator::class)
            ->needs('$customStubPath')
            ->give(function ($app) {
                return $app->basePath('stubs');
            });

        $this->registerRepository();

        $this->registerMigrator();

        $this->registerCreator();

        $this->commands([
            MigrateCommand::class,
            MakeCommand::class,
            InstallCommand::class,
            FreshCommand::class,
            RefreshCommand::class,
            ResetCommand::class,
            RollbackCommand::class,
            StatusCommand::class,
        ]);
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
    protected function registerMigrator(): void
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
    protected function registerCreator(): void
    {
        $this->app->singleton('migration.creator', function ($app) {
            $path = $app['config']['database.migrations_path'];

            return new MigrationCreator($app['files'], $path);
        });
    }
}
