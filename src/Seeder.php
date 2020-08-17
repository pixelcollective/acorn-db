<?php
namespace AcornDB;

use InvalidArgumentException;
use Illuminate\Support\Arr;
use Roots\Acorn\Application as Container;
use Roots\Acorn\Console\Commands\Command;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

/**
 * Seeder
 *
 * @author Kelly Mears <developers@tinypixel.dev>
 * @license MIT
 */
abstract class Seeder
{
    /** @var Container */
    protected $container;

    /** @var Command */
    protected $command;

    /**
     * Required method for implementations.
     */
    abstract function run();

    /**
     * Seed the given connection from the given path.
     *
     * @param  array|string  $class
     * @param  bool  $silent
     * @return $this
     */
    public function call($class, $silent = false)
    {
        $classes = Arr::wrap($class);

        foreach ($classes as $class) {
            if ($silent === false && isset($this->command)) {
                $this->command->getOutput()->writeln("<info>Seeding:</info> $class");
            }

            $this->resolve($class)->__invoke();
        }

        return $this;
    }

    /**
     * Silently seed the given connection from the given path.
     *
     * @param  array|string  $class
     * @return void
     */
    public function callSilent($class)
    {
        $this->call($class, true);
    }

    /**
     * Resolve an instance of the given seeder class.
     *
     * @param  string  $class
     * @return \Illuminate\Database\Seeder
     */
    protected function resolve($class)
    {
        if (isset($this->container)) {
            $instance = $this->container->make($class);

            $instance->setContainer($this->container);
        } else {
            $instance = new $class();
        }

        if (isset($this->command)) {
            $instance->setCommand($this->command);
        }

        return $instance;
    }

    /**
     * Set the IoC container instance.
     *
     * @param  Container  $container
     * @return $this
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;

        return $this;
    }

    /**
     * Set the console command instance.
     *
     * @param  Command  $command
     * @return Seeder
     */
    public function setCommand(Command $command)
    {
        $this->command = $command;

        return $this;
    }

    public function factory()
    {
        $factory = $this->container->make(EloquentFactory::class);

        $arguments = func_get_args();

        if (isset($arguments[1]) && is_string($arguments[1])) {
            return $factory->of($arguments[0], $arguments[1])->times($arguments[2] ?? null);
        } elseif (isset($arguments[1])) {
            return $factory->of($arguments[0])->times($arguments[1]);
        } else {
            return $factory->of($arguments[0]);
        }
    }

    /**
     * Run the database seeds.
     *
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function __invoke()
    {
        if (! method_exists($this, 'run')) {
            throw new InvalidArgumentException('Method [run] missing from :' . get_class($this));
        }

        return isset($this->container)
            ? $this->container->call([$this, 'run'])
            : $this->run();
    }
}
