<?php

use Faker\Generator as Faker;

$factory->define(App\Series::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'plot' => $faker->sentence,
        'year' => $faker->year,
        'country' => $faker->country,
        'seasons' => $faker->numberBetween(1, 27)
    ];
});
