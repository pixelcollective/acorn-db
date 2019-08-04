---
name: MigrateCommand
route: /console/commands/migrate/migratecommand
menu: Migrate
---


TinyPixel\Acorn\Database\Console\Commands\Migrate\MigrateCommand
===============



* Class name: MigrateCommand
* Namespace: TinyPixel\Acorn\Database\Console\Commands\Migrate
* Parent class: TinyPixel\Acorn\Database\Console\Commands\Migrate\BaseCommand





Properties
----------


### $signature

    protected string $signature = 'migrate {--database= : The database connection to use}
                {--force : Force the operation to run when in production}
                {--path=* : The path(s) to the migrations files to be executed}
                {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths}
                {--pretend : Dump the SQL queries that would be run}
                {--seed : Indicates if the seed task should be re-run}
                {--step : Force the migrations to be run so they can be rolled back individually}'

The name and signature of the console command.



* Visibility: **protected**


### $description

    protected string $description = 'Run the database migrations'

The console command description.



* Visibility: **protected**


### $migrator

    protected \Illuminate\Database\Migrations\Migrator $migrator

The migrator instance.



* Visibility: **protected**


### $name

    protected mixed $name = ' '





* Visibility: **protected**


Methods
-------


### __construct

    void TinyPixel\Acorn\Database\Console\Commands\Migrate\MigrateCommand::__construct()

Create a new migration command instance.



* Visibility: **public**




### handle

    void TinyPixel\Acorn\Database\Console\Commands\Migrate\MigrateCommand::handle()

Execute the console command.



* Visibility: **public**




### prepareDatabase

    void TinyPixel\Acorn\Database\Console\Commands\Migrate\MigrateCommand::prepareDatabase()

Prepare the migration database for running.



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



