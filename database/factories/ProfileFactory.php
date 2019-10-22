<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'last_name' => $faker->lastname,
        'first_name' => $faker->firstname,
        'year_old' => rand(18, 89),
        'phone' => '1234567890',
        'address' => $faker->address,
    ];
});
