<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Story;
use Faker\Generator as Faker;

$factory->define(Story::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4),
        'detials' => $faker->text,
    ];
});
