<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\General;
use Faker\Generator as Faker;

$factory->define(General::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4),
        'details' => $faker->text,
    ];
});
