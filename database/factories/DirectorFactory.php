<?php

use Faker\Generator as Faker;

$factory->define(App\Director::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'bio' => $faker->sentence,
        'gender' => 'female',
        'age' => 50
    ];
});
