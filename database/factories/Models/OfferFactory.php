<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Offer;
use Faker\Generator as Faker;

$factory->define(Offer::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4),
        'alumni_id' => $faker->word,
        'type' => $faker->randomElement(["offer","request"]),
        'detials' => $faker->text,
    ];
});
