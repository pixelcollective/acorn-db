---
name: SeedCommand
route: /console/commands/seeds/seedcommand
menu: Seeds
---


TinyPixel\Acorn\Database\Console\Commands\Seeds\SeedCommand
===============

 Seed Command 
 Seeds the database with records 
* Class name: SeedCommand
* Namespace: TinyPixel\Acorn\Database\Console\Commands\Seeds
* Parent class: Roots\Acorn\Console\Commands\Command





Properties
----------


### $name

    protected string $name = 'db:seed'

The console command name.



* Visibility: **protected**


### $description

    protected string $description = 'Seed the database with records'

The console command description.



* Visibility: **protected**


### $signature

    protected string $signature = 'db:seed {--class= : The class name of the root seeder}
                            {--database= : The database connection to seed.}
                            {--force : Force the operation to run when in production}'

The console command signature.



* Visibility: **protected**


### $resolver

    protected \Illuminate\Database\ConnectionResolverInterface $resolver

The connection resolver instance.



* Visibility: **protected**


Methods
-------


### __construct

    void TinyPixel\Acorn\Database\Console\Commands\Seeds\SeedCommand::__construct(\Illuminate\Database\ConnectionResolverInterface $resolver)

Create a new database seed command instance.



* Visibility: **public**


#### Arguments
* $resolver **Illuminate\Database\ConnectionResolverInterface**



### handle

    void TinyPixel\Acorn\Database\Console\Commands\Seeds\SeedCommand::handle()

Execute the console command.



* Visibility: **public**




### getSeeder

    \Illuminate\Database\Seeder TinyPixel\Acorn\Database\Console\Commands\Seeds\SeedCommand::getSeeder()

Get a seeder instance from the container.



* Visibility: **protected**




### getDatabase

    string TinyPixel\Acorn\Database\Console\Commands\Seeds\SeedCommand::getDatabase()

Get the name of the database connection to use.



* Visibility: **protected**




### getOptions

    array TinyPixel\Acorn\Database\Console\Commands\Seeds\SeedCommand::getOptions()

Get the console command options.



* Visibility: **protected**



