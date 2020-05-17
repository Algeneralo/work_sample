<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Alumnus;
use Faker\Generator as Faker;

$factory->define(Alumnus::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'gender' => $faker->randomElement(["m", "f"]),
        'street' => $faker->streetName,
        'street_number' => $faker->numberBetween(1, 999),
        'postcode' => $faker->postcode,
        'city' => $faker->city,
        'email' => $faker->safeEmail,
        'password' => bcrypt("password"),
        'dob' => $faker->date(),
        'university_id' => factory(\App\Models\University::class),
        'degree_program_id' => factory(\App\Models\DegreeProgram::class),
        'alumni_year' => $faker->numberBetween(1999, 2025),
        'description' => $faker->text,
        'telephone' => $faker->phoneNumber,
        'mobile' => $faker->phoneNumber,
        'is_team_member' => $faker->boolean,
    ];
});
