<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\DegreeProgram;
use Faker\Generator as Faker;

$factory->define(DegreeProgram::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
