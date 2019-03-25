<?php

use Faker\Generator as Faker;

$factory->define(
    App\Review::class,
    function (Faker $faker) {
        return [
            'headline' => $faker->sentence,
<<<<<<< HEAD
            'content' => $faker->paragraph($nbSentences = 2, $variableNbSentences = true),
=======
            'content' => $faker->sentence,
>>>>>>> 7159a6edab20bdff10cbddf46d50c9e8fcde2d40
            'user_id' => $faker->numberBetween($min = 1, $max = 5),
            'rating' => $faker->randomDigitNotNull,
            'movie_tmdb_id' => $faker->numberBetween($min = 2, $max = 585259),
        ];
    }
);
