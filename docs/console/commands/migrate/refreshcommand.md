---
name: RefreshCommand
route: /console/commands/migrate/refreshcommand
menu: Migrate
---


TinyPixel\Acorn\Database\Console\Commands\Migrate\RefreshCommand
===============



* Class name: RefreshCommand
* Namespace: TinyPixel\Acorn\Database\Console\Commands\Migrate
* Parent class: TinyPixel\Acorn\Database\Console\Commands\Migrate\BaseCommand





Properties
----------


### $name

    protected mixed $name = ' '





* Visibility: **protected**


### $description

    protected string $description = 'Reset and re-run all migrations'

The console command description.



* Visibility: **protected**


Methods
-------


### handle

    void TinyPixel\Acorn\Database\Console\Commands\Migrate\RefreshCommand::handle()

Execute the console command.



* Visibility: **public**




### runRollback

    void TinyPixel\Acorn\Database\Console\Commands\Migrate\RefreshCommand::runRollback(string $database, string $path, integer $step)

Run the rollback command.



* Visibility: **protected**


#### Arguments
* $database **string**
* $path **string**
* $step **integer**



### runReset

    void TinyPixel\Acorn\Database\Console\Commands\Migrate\RefreshCommand::runReset(string $database, string $path)

Run the reset command.



* Visibility: **protected**


#### Arguments
* $database **string**
* $path **string**



### needsSeeding

    boolean TinyPixel\Acorn\Database\Console\Commands\Migrate\RefreshCommand::needsSeeding()

Determine if the developer has requested database seeding.



* Visibility: **protected**




### runSeeder

    void TinyPixel\Acorn\Database\Console\Commands\Migrate\RefreshCommand::runSeeder(string $database)

Run the database seeder command.



* Visibility: **protected**


#### Arguments
* $database **string**



### getOptions

    array TinyPixel\Acorn\Database\Console\Commands\Migrate\RefreshCommand::getOptions()

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



