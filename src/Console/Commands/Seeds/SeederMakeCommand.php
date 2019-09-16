<?php

namespace TinyPixel\AcornDB\Console\Commands\Seeds;

use function Roots\base_path;
use Illuminate\Support\Composer;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;
use Roots\Acorn\Console\Commands\GeneratorCommand;

/**
 * Console Command: Seeder Make
 *
 * Usage: `wp acorn make:seeder`
 *
 * @author     Kelly Mears <developers@tinypixel.dev>
 * @license    MIT
 * @version    1.0.0
 * @since      1.0.0
 * @package    AcornDB
 * @subpackage Console\Commands
 **/
class SeederMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     **/
    protected $name = 'make:seeder';

    /**
     * The console command description.
     *
     * @var string
     **/
    protected $description = 'Create a new seeder class';

    /**
     * The type of class being generated.
     *
     * @var string
     **/
    protected $type = 'Seeder';

    /**
     * The Composer instance.
     *
     * @var \Illuminate\Support\Composer
     **/
    protected $composer;

    /**
     * Create a new command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  \Illuminate\Support\Composer  $composer
     * @return void
     **/
    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct($files);

        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return void
     **/
    public function handle()
    {
        parent::handle();
        $this->composer->dumpAutoloads();
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     **/
    protected function getStub()
    {
        return __DIR__ . '/stubs/seeder.stub';
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     **/
    protected function getPath($name)
    {
        return base_path('/database/seeds/' . $this->input->getArgument('name') . '.php');
    }

    /**
     * Parse the class name and format according to the root namespace.
     *
     * @param  string  $name
     * @return string
     **/
    protected function qualifyClass($name)
    {
        return $this->input->getArgument('name');
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     **/
    protected function getNameInput()
    {
        return $this->input->getArgument('name');
    }
}
