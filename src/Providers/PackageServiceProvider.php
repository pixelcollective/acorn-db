<?php

namespace TinyPixel\Acorn\Database\Providers;

use Roots\Acorn\ServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Faker\Generator as FakerGenerator;

/**
 * Acorn database service provider
 *
 * @author  Kelly Mears <kelly@tinypixel.dev>
 * @license MIT
 * @since   1.0.0
 *
 * @package    Acorn\Database
 * @subpackage Providers
 **/
class PackageServiceProvider extends ServiceProvider
{
    /**
     * Console commands
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
        'TinyPixel\Acorn\Database\Console\Commands\Factories\FactoryMakeCommand',
    ];

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../publishes/Model'               => $this->modelDirectory(),
            __DIR__ . '/../../publishes/config/database.php' => $this->app->configPath('database.php'),
            __DIR__ . '/../../publishes/database'            => $this->app->basePath('database'),
        ], 'Acorn Database');

        $this->commands($this->commands);

        $this->registerFrom($this->app->basePath('database/seeds'));
    }

    /**
     * Return the App/Model directory
     */
    protected function modelDirectory()
    {
        return $this->app->basePath($this->appDirectory() . '/Model');
    }

    /**
     * Return the App directory.
     */
    protected function appDirectory()
    {
        return substr(strtolower($this->app->getNamespace()), 0, -1);
    }

    /**
     * Register database seeders
     *
     * @param  string $path
     * @return void
     **/
    protected function registerFrom(string $path) : void
    {
        foreach (glob("$path/*.php") as $filename) {
            require $filename;
        }
    }
}
