---
name: InstallCommand
route: /console/commands/migrate/installcommand
menu: Migrate
---


TinyPixel\Acorn\Database\Console\Commands\Migrate\InstallCommand
===============



* Class name: InstallCommand
* Namespace: TinyPixel\Acorn\Database\Console\Commands\Migrate
* Parent class: TinyPixel\Acorn\Database\Console\Commands\Migrate\BaseCommand





Properties
----------


### $name

    protected mixed $name = ' '





* Visibility: **protected**


### $description

    protected string $description = 'Create the migration repository'

The console command description.



* Visibility: **protected**


### $repository

    protected \Illuminate\Database\Migrations\MigrationRepositoryInterface $repository

The repository instance.



* Visibility: **protected**


Methods
-------


### __construct

    void TinyPixel\Acorn\Database\Console\Commands\Migrate\InstallCommand::__construct(\Roots\Acorn\Application $app)

Create a new migration install command instance.



* Visibility: **public**


#### Arguments
* $app **Roots\Acorn\Application**



### handle

    void TinyPixel\Acorn\Database\Console\Commands\Migrate\InstallCommand::handle()

Execute the console command.



* Visibility: **public**




### getOptions

    array TinyPixel\Acorn\Database\Console\Commands\Migrate\InstallCommand::getOptions()

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



