<?php

use Faker\Generator as Faker;

$factory->define(App\Student::class, function (Faker $faker) {
    return [
        "firstName" => $faker->firstName,
        "lastName" => $faker->lastName
    ];
});
