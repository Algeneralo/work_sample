<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Podcast;
use Faker\Generator as Faker;

$factory->define(Podcast::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4),
        'details' => $faker->text,
    ];
});
