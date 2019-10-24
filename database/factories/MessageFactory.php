<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'content' => $faker->text,
        'fk_canal_id' => function () {
            return factory(Canal::class)->create()->canal_id;
        },
        'fk_profile_id' => function () {
            return factory(Profile::class)->create()->profile_id;
        },
    ];
});
