<?php

namespace TinyPixel\AcornDB\Providers;

use Roots\Acorn\ServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Faker\Generator as FakerGenerator;
use TinyPixel\Support\Util;

/**
 * Acorn database service provider
 *
 * @author  Kelly Mears <kelly@tinypixel.dev>
 * @license MIT
 * @since   1.0.0
 *
 * @package    AcornDB
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
        'TinyPixel\AcornDB\Console\Commands\Migrate\FreshCommand',
        'TinyPixel\AcornDB\Console\Commands\Migrate\InstallCommand',
        'TinyPixel\AcornDB\Console\Commands\Migrate\MakeCommand',
        'TinyPixel\AcornDB\Console\Commands\Migrate\MigrateCommand',
        'TinyPixel\AcornDB\Console\Commands\Migrate\RefreshCommand',
        'TinyPixel\AcornDB\Console\Commands\Migrate\ResetCommand',
        'TinyPixel\AcornDB\Console\Commands\Migrate\RollbackCommand',
        'TinyPixel\AcornDB\Console\Commands\Migrate\StatusCommand',
        'TinyPixel\AcornDB\Console\Commands\Seeds\SeedCommand',
        'TinyPixel\AcornDB\Console\Commands\Seeds\SeederMakeCommand',
        'TinyPixel\AcornDB\Console\Commands\Factories\FactoryMakeCommand',
    ];

    public function register()
    {
        $this->app->bind('tinypixel.util', function ($app) {
            return Util::getInstance()->container['util'];
        });
    }

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
