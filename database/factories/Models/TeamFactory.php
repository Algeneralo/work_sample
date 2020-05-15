<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Team;
use Faker\Generator as Faker;

$factory->define(Team::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'gender' => $faker->randomElement(["m", "f"]),
        'street' => $faker->streetName,
        'street_number' => $faker->numberBetween(1, 999),
        'postcode' => $faker->postcode,
        'city' => $faker->city,
        'email' => $faker->safeEmail,
        'password' => "password",
        'dob' => $faker->date(),
        'telephone' => $faker->phoneNumber,
        'mobile' => $faker->phoneNumber,
    ];
});
