<?php

namespace Illuminate\Database\Console\Factories;

use Roots\Acorn\Application;
use Symfony\Component\Console\Input\InputOption;
use Roots\Acorn\Console\Commands\GeneratorCommand;

/**
 * Factory Make Command
 *
 * Usage: `wp acorn make:seeder`
 *
 * @package    AcornDB
 * @subpackage Commands
 * @version    1.0.0
 * @since      1.0.0
 * @author     Kelly Mears <developers@tinypixel.dev>
 * @license    MIT
 */
class FactoryMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:factory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model factory';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Factory';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/factory.stub';
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $namespaceModel = $this->input->getOption('model')
                        ? $this->qualifyClass($this->input->getOption('model'))
                        : trim($this->rootNamespace(), '\\') . '\\Model';

        $model = class_basename($namespaceModel);

        return str_replace(
            [
                'NamespacedDummyModel',
                'DummyModel',
            ],
            [
                $namespaceModel,
                $model,
            ],
            parent::buildClass($name)
        );
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = str_replace(
            ['\\', '/'],
            '',
            $this->argument('name')
        );

        return $this->laravel->databasePath() . "/factories/{$name}.php";
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', 'm', InputOption::VALUE_OPTIONAL, 'The name of the model'],
        ];
    }
}
