<?php

use App\Series;
use Illuminate\Database\Seeder;

class SeriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Series::create(array(
            'id' => 1,
            'title' => 'Game of Thrones',
            'air_start' => 2011,
            'air_end' => null,
            'country' => 'USA',
            'imdb_id' => 'tt0088245',
            'genre' => 'Fantasy',
            'total_seasons' => 8
        ));
    }
}
