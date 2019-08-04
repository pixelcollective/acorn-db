---
name: RollbackCommand
route: /console/commands/migrate/rollbackcommand
menu: Migrate
---


TinyPixel\Acorn\Database\Console\Commands\Migrate\RollbackCommand
===============



* Class name: RollbackCommand
* Namespace: TinyPixel\Acorn\Database\Console\Commands\Migrate
* Parent class: TinyPixel\Acorn\Database\Console\Commands\Migrate\BaseCommand





Properties
----------


### $name

    protected mixed $name = ' '





* Visibility: **protected**


### $description

    protected string $description = 'Rollback the last database migration'

The console command description.



* Visibility: **protected**


### $migrator

    protected \Illuminate\Database\Migrations\Migrator $migrator

The migrator instance.



* Visibility: **protected**


Methods
-------


### __construct

    void TinyPixel\Acorn\Database\Console\Commands\Migrate\RollbackCommand::__construct(\Roots\Acorn\Application $app)

Create a new migration rollback command instance.



* Visibility: **public**


#### Arguments
* $app **Roots\Acorn\Application**



### handle

    void TinyPixel\Acorn\Database\Console\Commands\Migrate\RollbackCommand::handle()

Execute the console command.



* Visibility: **public**




### getOptions

    array TinyPixel\Acorn\Database\Console\Commands\Migrate\RollbackCommand::getOptions()

Get the console command options.



* Visibility: **protected**




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




### getMigrationPath

    string TinyPixel\Acorn\Database\Console\Commands\Migrate\BaseCommand::getMigrationPath()

Get the path to the migration directory.



* Visibility: **protected**
* This method is defined by TinyPixel\Acorn\Database\Console\Commands\Migrate\BaseCommand



