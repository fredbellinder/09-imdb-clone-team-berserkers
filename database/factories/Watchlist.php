<?php

use Faker\Generator as Faker;

$factory->define(
    App\Watchlist::class,
    function (Faker $faker) {
        $movie = array(
            ["poster_url" => "http://image.tmdb.org/t/p/w185//adw6Lq9FiC9zjYEpOqfq03ituwp.jpg",
            "title" => "Fight Club",
            "id" => 550],
            ["poster_url" => "http://image.tmdb.org/t/p/w185//adw6Lq9FiC9zjYEpOqfq03ituwp.jpg",
            "title" => "Interstellar",
            "id" => 220]);
    
        return [
        'title' => $faker->word,
        'list_items' => $movie,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },

        ];
    }
);
