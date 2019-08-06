<?php

namespace TinyPixel\Acorn\Database\Console\Commands\Migrate;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Database\Migrations\MigrationCreator;

use TinyPixel\Acorn\Database\Console\Commands\Migrate\BaseCommand;
use function Roots\base_path;

class MakeCommand extends BaseCommand
{
    /**
     * The console command name.
     *
     * @var string
     **/
    protected $name = 'migrate:make';

    /**
     * The console command signature.
     *
     * @var string
     **/
    protected $signature = 'migrate:make {name : The name of your migration}
                            {table : The table to migrate.}
                            {--create : Creates table}';

    /**
     * The description of the command.
     *
     * @var string
     **/
    protected $description = 'Create a new migration file';

    /**
     * The migration creator instance.
     *
     * @var \Illuminate\Database\Migrations\MigrationCreator
     **/
    protected $creator;

    public function __construct(MigrationCreator $creator)
    {
        parent::__construct();

        $this->creator = $creator;
    }

    /**
     * Execute the console command.
     *
     * @return void
     **/
    public function handle()
    {
        // It's possible for the developer to specify the tables to modify in this
        // schema operation. The developer may also specify if this table needs
        // to be freshly created so we can create the appropriate migrations.
        $name = $this->argument('name');

        $table = $this->argument('table');

        $create = $this->option('create');

        if (! $table && is_string($create)) {
            $table = $create;
        }

        // Now we are ready to write the migration out to disk. Once we've written
        // the migration out, we will dump-autoload for the entire framework to
        // make sure that the migrations are registered by the class loaders.
        $this->writeMigration($name, $table, $create);
    }

    /**
     * Write the migration file to disk.
     *
     * @param  string  $name
     * @param  string  $table
     * @param  bool    $create
     * @return string
     **/
    protected function writeMigration($name, $table, $create)
    {
        $path = $this->getMigrationPath();

        $this->creator->create($name, $path, $table, $create);

        $this->output->newLine();
        $this->output->writeln("<bg=blue;fg=white;>Migration created!</>");
        $this->output->writeln("<info>Name:</info> {$name}");
        $this->output->write("<info>Table:</info> {$table}");

        if ($create) {
            $this->output->write(" <bg=blue;fg=white;>Note: new database table created.</>");
        }

        $this->output->newLine();
        $this->output->writeln("<info>Directory:</info> {$path}");
        $this->output->newLine();
    }

    protected function getMigrationPath()
    {
        return base_path() . '/database/migrations';
    }
}
