<?php

namespace AcornDB\Providers;

use Auth;
use Corcel\Corcel;
use Corcel\Laravel\Auth\AuthUserProvider;
use Thunder\Shortcode\Parser\RegularParser;
use Thunder\Shortcode\ShortcodeFacade;
use Roots\Acorn\ServiceProvider;

/**
 * Acorn database service provider
 *
 * @package AcornDB
 */
class PackageServiceProvider extends ServiceProvider
{
    /**
     * Console commands
     *
     * @var array
     */
    public $commands = [
        'AcornDB\Console\Commands\Seeds\SeedCommand',
        'AcornDB\Console\Commands\Seeds\SeederMakeCommand',
        'AcornDB\Console\Commands\Factories\FactoryMakeCommand',
    ];

    public function register()
    {
        $this->app->bind(ShortcodeFacade::class, function () {
            return tap(new ShortcodeFacade(), function (ShortcodeFacade $facade) {
                $parser_class = $this->app->get('config')->get('corcel.shortcode_parser', RegularParser::class);
                $facade->setParser(new $parser_class);
            });
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../publishes/config/database.php' => $this->app->configPath('database.php'),
        ], 'Acorn Database');

        $this->registerFrom($this->app->basePath('database/seeds'));
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
