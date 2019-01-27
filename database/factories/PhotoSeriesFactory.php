<?php

use Faker\Generator as Faker;

$factory->define(App\Photoseries::class, function (Faker $faker) {
    return [
        'series_id' => factory(App\Series::class)->create()->id,
        'image' => $faker->image('public/assets/images/series', 400,300)
    ];
});
