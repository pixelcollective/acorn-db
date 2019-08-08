<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\User;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'login'       => $faker->userName,
        'email'       => $faker->safeEmail,
        'slug'        => $faker->userName,
        'url'         => "https://{$faker->domainWord}.{$faker->tld}",
        'nickname'    => $faker->userName,
        'first_name'  => $faker->firstName,
        'last_name'   => $faker->lastName,
        'description' => $faker->text,
        'created_at'  => Carbon::now()->toDateTimeString(),
    ];
});
