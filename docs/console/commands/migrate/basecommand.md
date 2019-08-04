---
name: BaseCommand
route: /console/commands/migrate/basecommand
menu: Migrate
---


TinyPixel\Acorn\Database\Console\Commands\Migrate\BaseCommand
===============



* Class name: BaseCommand
* Namespace: TinyPixel\Acorn\Database\Console\Commands\Migrate
* Parent class: Roots\Acorn\Console\Commands\Command





Properties
----------


### $name

    protected mixed $name = ' '





* Visibility: **protected**


Methods
-------


### getMigrationPaths

    array TinyPixel\Acorn\Database\Console\Commands\Migrate\BaseCommand::getMigrationPaths()

Get all of the migration paths.



* Visibility: **protected**




### usingRealPath

    boolean TinyPixel\Acorn\Database\Console\Commands\Migrate\BaseCommand::usingRealPath()

Determine if the given path(s) are pre-resolved "real" paths.



* Visibility: **protected**




### getMigrationPath

    string TinyPixel\Acorn\Database\Console\Commands\Migrate\BaseCommand::getMigrationPath()

Get the path to the migration directory.



* Visibility: **protected**



