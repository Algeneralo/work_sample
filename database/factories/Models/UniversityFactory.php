<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\University;
use Faker\Generator as Faker;

$factory->define(University::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
