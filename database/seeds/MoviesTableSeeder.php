<?php

use App\Movie;
use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::create(array(
            'id' => 1,
            'title' => 'Zog',
            'year' => 2018,
            'country' => 'UK',
            'imdb_id' => 'tt9109620',
            'genre' => 'Animation',
            'runtime' => '120 min'
        ));

        Movie::create(array(
            'id' => 2,
            'title' => 'The Terminator',
            'year' => 1984,
            'country' => 'USA',
            'imdb_id' => 'tt0088247',
            'genre' => 'Action',
            'runtime' => '141 min'
        ));
    }
}
