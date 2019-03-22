<?php

use Faker\Generator as Faker;

$factory->define(
    App\Review::class,
    function (Faker $faker) {
        return [
            'headline' => $faker->sentence,
            'content' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'user_id' => $faker->numberBetween($min = 1, $max = 5),
            'rating' => $faker->randomDigitNotNull,
            'movie_tmdb_id' => $faker->numberBetween($min = 2, $max = 585259),
        ];
    }
);
