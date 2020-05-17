<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Event;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'street' => $faker->streetName,
        'street_number' => $faker->numberBetween(1, 999),
        'postcode' => $faker->postcode,
        'city' => $faker->city,
        'details' => $faker->text,
        'max_participants' => $faker->numberBetween(1, 30),
        'date' => $faker->dateTimeBetween( '-3 months',"+ 4 days")->format( 'Y-m-d'),
        'start_time' => $faker->time(),
        'end_time' => $faker->time(),
        "category_id" => function () {
            return factory(\App\Models\Category::class)->create()->id;
        },
    ];
});
