<?php

use \TinyPixel\AcornDB\Seeder;

/*
|--------------------------------------------------------------------------
| Application Database Seeding
|--------------------------------------------------------------------------
|
| All seed classes are stored in the database/seeds directory.
| Seed classes may have any name you wish, but probably should follow some
| sensible convention, such as PostSeeder, etc. By default, a
| DatabaseSeeder class is defined for you. From this class, you may
| use the call method to run other seed classes, allowing you to control
| the seeding order.
|
| @see https://laravel.com/docs/5.8/seeding
|
*/
class DatabaseSeeder extends Seeder
{
    /**
     * Run the application's database seeds.
     *
     * @return void
     **/
    public function run()
    {
        $this->call(PostSeeder::class);
    }
}
