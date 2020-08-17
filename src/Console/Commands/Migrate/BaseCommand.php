<?php

namespace AcornDB\Console\Commands\Migrate;

use Roots\Acorn\Application;
use Roots\Acorn\Console\Commands\Command;

/**
 * Migration base command.
 *
 * @author  Kelly Mears <developers@tinypixel.dev>
 * @license MIT
 */
class BaseCommand extends Command
{
    /**
     * Instantiate the Acorn container.
     *
     * @param  Application $app
     * @return void
     */
    protected function app(Application $app) : void
    {
        $this->app = $app;
    }

    /**
     * Get all of the migration paths.
     *
     * @return array
     **/
    protected function getMigrationPaths()
    {
        // Here, we will check to see if a path option has been defined. If it has we will
        // use the path relative to the root of the installation folder so our database
        // migrations may be run for any customized path from within the application.
        if ($this->input->hasOption('path') && $this->option('path')) {
            return collect($this->option('path'))->map(function ($path) {
                return !$this->usingRealPath() ? $this->app->basePath() . DIRECTORY_SEPARATOR . $path : $path;
            })->all();
        }
        return array_merge($this->migrator->paths(), [
            $this->getMigrationPath()
        ]);
    }

    /**
     * Determine if the given path(s) are pre-resolved "real" paths.
     *
     * @return bool
     **/
    protected function usingRealPath()
    {
        return $this->input->hasOption('realpath') && $this->option('realpath');
    }

    /**
     * Get the path to the migration directory.
     *
     * @return string
     **/
    protected function getMigrationPath()
    {
        return $this->app['config']->get('database.migrations_path');
    }
}
