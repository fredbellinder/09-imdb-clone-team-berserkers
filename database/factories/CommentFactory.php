<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'headline' => $faker->sentence,
        'content' => $faker->sentence,
        'user_id' => 1,
        'user_name' => "Daniel Salin",
        'movie_tmdb_id' =>458723,
        'review_id' => 1,
    ];
});
