---
name: DatabaseServiceProvider
route: /providers/databaseserviceprovider
menu: Providers
---


TinyPixel\Acorn\Database\Providers\DatabaseServiceProvider
===============

 Acorn DB service provider 

* Class name: DatabaseServiceProvider
* Namespace: TinyPixel\Acorn\Database\Providers
* Parent class: Roots\Acorn\ServiceProvider





Properties
----------


### $commands

    public array $commands = array('TinyPixel\Acorn\Database\Console\Commands\Migrate\InstallCommand', 'TinyPixel\Acorn\Database\Console\Commands\Migrate\MakeCommand', 'TinyPixel\Acorn\Database\Console\Commands\Migrate\MigrateCommand', 'TinyPixel\Acorn\Database\Console\Commands\Migrate\RefreshCommand', 'TinyPixel\Acorn\Database\Console\Commands\Migrate\ResetCommand', 'TinyPixel\Acorn\Database\Console\Commands\Migrate\RollbackCommand', 'TinyPixel\Acorn\Database\Console\Commands\Migrate\StatusCommand', 'TinyPixel\Acorn\Database\Console\Commands\Seeds\SeedCommand', 'TinyPixel\Acorn\Database\Console\Commands\Seeds\SeederMakeCommand')

Acorn Commands



* Visibility: **public**


Methods
-------


### register

    void TinyPixel\Acorn\Database\Providers\DatabaseServiceProvider::register()

Register any application services.



* Visibility: **public**




### boot

    void TinyPixel\Acorn\Database\Providers\DatabaseServiceProvider::boot()

Bootstrap any application services.



* Visibility: **public**




### registerSeedersFrom

    void TinyPixel\Acorn\Database\Providers\DatabaseServiceProvider::registerSeedersFrom($path)

Register seeders



* Visibility: **protected**


#### Arguments
* $path **mixed**


