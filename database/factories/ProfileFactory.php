<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'pseudo' => $faker->lastname,
        'nom' => $faker->lastname,
        'prenom' => $faker->firstname,
        'age' => rand(18, 89),
        'telephone' => '1234567890',
    ];
});
