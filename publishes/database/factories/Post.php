<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Post;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Post Factory
|--------------------------------------------------------------------------
|
| Factories provide a convenient way to generate new model
| instances for testing / seeding your application's database.
|
*/

$factory->define(Post::class, function (Faker $faker) {
    return [
        'post_title'            => $faker->title(),
        'post_excerpt'          => $faker->sentence(),
        'post_content'          => $faker->paragraph(),
        'post_date'             => Carbon::now()->toDateTimeString(),
        'post_date_gmt'         => Carbon::now('gmt')->toDateTimeString(),
        'post_modified'         => Carbon::now()->toDateTimeString(),
        'post_modified_gmt'     => Carbon::now('gmt')->toDateTimeString(),
        'post_author'           => 1,
        'to_ping'               => '',
        'pinged'                => '',
        'post_content_filtered' => '',
        'post_name'             => $faker->slug(),
    ];
});

$factory->afterMaking(App\Model\Post::class, function ($post, $faker) {
    $post->save(factory(App\Model\Comment::class)->make());
});
