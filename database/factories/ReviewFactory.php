<?php

use Faker\Generator as Faker;

$factory->define(
    App\Review::class,
    function (Faker $faker) {
        return [
            'headline' => $faker->sentence,
            'content' => $faker->sentence,
            'user_id' => 6,
            // 'user_id' => $faker->numberBetween($min = 1, $max = 5),
            'rating' => $faker->randomDigitNotNull,
            'movie_tmdb_id' => $faker->numberBetween($min = 550, $max = 1000),
            // 'movie_tmdb_id' => $faker->numberBetween($min = 2, $max = 585259),
            'movie_title' => $faker->word,
        ];
    }
);
