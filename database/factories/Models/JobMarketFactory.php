<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\JobMarket;
use Faker\Generator as Faker;

$factory->define(JobMarket::class, function (Faker $faker) {
    return [
        'employer' => $faker->word,
        'offer' => $faker->word,
        'category_id' => $faker->word,
        'working_hours' => $faker->randomElement(["full_time","part_time"]),
        'beginning' => $faker->date(),
        'details' => $faker->text,
    ];
});
