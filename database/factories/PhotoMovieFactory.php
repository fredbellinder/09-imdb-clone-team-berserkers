<?php

use Faker\Generator as Faker;

$factory->define(App\Photomovie::class, function (Faker $faker) {
    return [
        'movie_id' => factory(App\Movie::class)->create()->id,
        'image' => $faker->image('public/assets/images/movie', 400,300)
    ];
});
