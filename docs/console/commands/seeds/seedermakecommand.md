---
name: SeederMakeCommand
route: /console/commands/seeds/seedermakecommand
menu: Seeds
---


TinyPixel\Acorn\Database\Console\Commands\Seeds\SeederMakeCommand
===============

 Seeder Make Command 
 Usage: `wp acorn make:seeder` 
* Class name: SeederMakeCommand
* Namespace: TinyPixel\Acorn\Database\Console\Commands\Seeds
* Parent class: Roots\Acorn\Console\Commands\GeneratorCommand





Properties
----------


### $name

    protected string $name = 'make:seeder'

The console command name.



* Visibility: **protected**


### $description

    protected string $description = 'Create a new seeder class'

The console command description.



* Visibility: **protected**


### $type

    protected string $type = 'Seeder'

The type of class being generated.



* Visibility: **protected**


### $composer

    protected \Illuminate\Support\Composer $composer

The Composer instance.



* Visibility: **protected**


Methods
-------


### __construct

    void TinyPixel\Acorn\Database\Console\Commands\Seeds\SeederMakeCommand::__construct(\Illuminate\Filesystem\Filesystem $files, \Illuminate\Support\Composer $composer)

Create a new command instance.



* Visibility: **public**


#### Arguments
* $files **Illuminate\Filesystem\Filesystem**
* $composer **Illuminate\Support\Composer**



### handle

    void TinyPixel\Acorn\Database\Console\Commands\Seeds\SeederMakeCommand::handle()

Execute the console command.



* Visibility: **public**




### getStub

    string TinyPixel\Acorn\Database\Console\Commands\Seeds\SeederMakeCommand::getStub()

Get the stub file for the generator.



* Visibility: **protected**




### getPath

    string TinyPixel\Acorn\Database\Console\Commands\Seeds\SeederMakeCommand::getPath(string $name)

Get the destination class path.



* Visibility: **protected**


#### Arguments
* $name **string**



### qualifyClass

    string TinyPixel\Acorn\Database\Console\Commands\Seeds\SeederMakeCommand::qualifyClass(string $name)

Parse the class name and format according to the root namespace.



* Visibility: **protected**


#### Arguments
* $name **string**



### getNameInput

    string TinyPixel\Acorn\Database\Console\Commands\Seeds\SeederMakeCommand::getNameInput()

Get the desired class name from the input.



* Visibility: **protected**



