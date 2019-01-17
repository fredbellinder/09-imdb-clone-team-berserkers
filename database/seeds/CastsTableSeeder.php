<?php

use App\Cast;
use Illuminate\Database\Seeder;

class CastsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cast::create(array(
            'id' => 1,
            'person_id' => 1
        ));
        Cast::create(array(
            'id' => 2,
            'person_id' => 2
        ));
        Cast::create(array(
            'id' => 3,
            'person_id' => 1
        ));
    }
}
