<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Gallery;
use Faker\Generator as Faker;

$factory->define(Gallery::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4),
        'details' => $faker->text,
    ];
});
