<?php

use Faker\Generator as Faker;

$factory->define(App\Watchlist::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'movie_tmdb_id' => 550,
        'tv_tmdb_id' => null,
        'poster_url' => 'http://image.tmdb.org/t/p/w185//adw6Lq9FiC9zjYEpOqfq03ituwp.jpg',
    ];
    }
);
