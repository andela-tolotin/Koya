<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Koya\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'username' => $faker->unique()->userName,
        'password' => bcrypt(str_random(10)),
        'provider' => $faker->randomElement(['github', 'twitter', 'facebook']),
        'provider_id' => $faker->uuid,
        'provider_token' => $faker->uuid,
        'avatar' => $faker->url,
        'remember_token' => str_random(10),
    ];
});