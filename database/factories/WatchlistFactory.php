<?php

use Faker\Generator as Faker;

$factory->state(App\Watchlist::class, 'user_id', [
    'user_id' => 1,
]);

$factory->define(
    App\Watchlist::class,
    function (Faker $faker) {
        $movie = array(
            ["poster_url" => "/adw6Lq9FiC9zjYEpOqfq03ituwp.jpg",
            "title" => "Fight Club",
            "id" => 550],
            ["poster_url" => "/nBNZadXqJSdt05SHLqgT0HuC5Gm.jpg",
            "title" => "Interstellar",
            "id" => 157336]);
    
        return [
        'title' => $faker->word,
        'list_items' => $movie,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        ];
    }
);
