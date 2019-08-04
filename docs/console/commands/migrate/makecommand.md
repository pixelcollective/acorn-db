---
name: MakeCommand
route: /console/commands/migrate/makecommand
menu: Migrate
---


TinyPixel\Acorn\Database\Console\Commands\Migrate\MakeCommand
===============



* Class name: MakeCommand
* Namespace: TinyPixel\Acorn\Database\Console\Commands\Migrate
* Parent class: TinyPixel\Acorn\Database\Console\Commands\Migrate\BaseCommand





Properties
----------


### $name

    protected mixed $name = ' '





* Visibility: **protected**


### $signature

    protected string $signature = 'migrate:make {name : The name of your migration}
                            {table : The table to migrate.}
                            {--create : Creates table}'

The console command signature.



* Visibility: **protected**


### $description

    protected string $description = 'Create a new migration file'

The description of the command.



* Visibility: **protected**


### $creator

    protected \Illuminate\Database\Migrations\MigrationCreator $creator

The migration creator instance.



* Visibility: **protected**


Methods
-------


### __construct

    mixed TinyPixel\Acorn\Database\Console\Commands\Migrate\MakeCommand::__construct(\Illuminate\Database\Migrations\MigrationCreator $creator)





* Visibility: **public**


#### Arguments
* $creator **Illuminate\Database\Migrations\MigrationCreator**



### handle

    void TinyPixel\Acorn\Database\Console\Commands\Migrate\MakeCommand::handle()

Execute the console command.



* Visibility: **public**




### writeMigration

    string TinyPixel\Acorn\Database\Console\Commands\Migrate\MakeCommand::writeMigration(string $name, string $table, boolean $create)

Write the migration file to disk.



* Visibility: **protected**


#### Arguments
* $name **string**
* $table **string**
* $create **boolean**



### getMigrationPath

    string TinyPixel\Acorn\Database\Console\Commands\Migrate\BaseCommand::getMigrationPath()

Get the path to the migration directory.



* Visibility: **protected**
* This method is defined by TinyPixel\Acorn\Database\Console\Commands\Migrate\BaseCommand




### getMigrationPaths

    array TinyPixel\Acorn\Database\Console\Commands\Migrate\BaseCommand::getMigrationPaths()

Get all of the migration paths.



* Visibility: **protected**
* This method is defined by TinyPixel\Acorn\Database\Console\Commands\Migrate\BaseCommand




### usingRealPath

    boolean TinyPixel\Acorn\Database\Console\Commands\Migrate\BaseCommand::usingRealPath()

Determine if the given path(s) are pre-resolved "real" paths.



* Visibility: **protected**
* This method is defined by TinyPixel\Acorn\Database\Console\Commands\Migrate\BaseCommand



