<?php
use App\Work;
use Illuminate\Database\Seeder;

class WorksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Work::create(array(
            'id' => 1,
            'title' => 'Zog',
            'type' => 'movie',
            'year' => 2018,
            'country' => 'UK',
            'imdb_id' => 'tt9109620',
            'genre' => 'Animation',
            'runtime' => '120 min'
        ));

        Work::create(array(
            'id' => 2,
            'title' => 'Terminator',
            'type' => 'movie',
            'year' => 1984,
            'country' => 'USA',
            'imdb_id' => 'tt0088247',
            'genre' => 'Action',
            'runtime' => '141 min'
        ));

        Work::create(array(
            'id' => 3,
            'title' => 'GOT',
            'type' => 'series',
            'year' => 2011,
            'country' => 'USA',
            'imdb_id' => 'tt0088245',
            'genre' => 'Fantasy',
            'runtime' => '141 min',
            'total_seasons' => 11
        ));
    }
}
