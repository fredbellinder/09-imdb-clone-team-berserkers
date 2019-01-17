<?php

use App\Direction;
use Illuminate\Database\Seeder;

class DirectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Direction::create(array(
            'id' => 1,
            'person_id' => 3
        ));
    }
}
