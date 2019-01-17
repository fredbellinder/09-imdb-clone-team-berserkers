<?php

use App\Production;
use Illuminate\Database\Seeder;

class ProductionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Production::create(array(
            'id' => 1,
            'type' => 'movie',
            'movie_id' => 1,
            'cast_id' => 1,
        ));

        Production::create(array(
            'id' => 2,
            'type' => 'movie',
            'movie_id' => 2,
            'cast_id' => 2,
            'direction_id' => 1
        ));

        Production::create(array(
            'id' => 3,
            'type' => 'series',
            'series_id' => 1,
            'cast_id' => 1
        ));
    }
}
