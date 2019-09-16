<?php

use App\Model\Post;
use Faker\Generator as Faker;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Post Factory
|--------------------------------------------------------------------------
|
| Manually specifying the attributes for each model seed is
| cumbersome. Factories provide a convenient way to generate new model
| instances for scaffolding or testing your application's database.
|
| Within the Closure, which serves as the factory definition, you may
| return the default test values of all attributes on the model. The Closure
| will receive an instance of the Faker PHP library, which allows you to
| conveniently generate various kinds of random data for testing.
|
| @link https://laravel.com/docs/5.8/database-testing#writing-factories
| @link https://github.com/fzaninotto/Faker#formatters
|
*/

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'                 => $faker->sentence(),
        'excerpt'               => $faker->sentence() . $faker->sentence(),
        'content'               => $faker->paragraph(),
        'post_author'           => 1,
        'post_name'             => $faker->slug(),
        'date'                  => Carbon::now()->toDateTimeString(),
        'post_date_gmt'         => Carbon::now('gmt')->toDateTimeString(),
        'modified'              => Carbon::now()->toDateTimeString(),
        'post_modified_gmt'     => Carbon::now('gmt')->toDateTimeString(),
        'post_content_filtered' => '',
        'to_ping'               => '',
        'pinged'                => '',
    ];
});
