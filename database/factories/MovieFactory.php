<?php

use Faker\Generator as Faker;

$factory->define(App\Movie::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'plot' => $faker->sentence,
        'year' => $faker->year,
        'country' => $faker->country,
        'runtime' => '160 min'
    ];
});
