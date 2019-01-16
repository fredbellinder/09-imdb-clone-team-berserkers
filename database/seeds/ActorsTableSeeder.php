<?php
use App\Actor;
use Illuminate\Database\Seeder;

class ActorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Actor::create(array(
            'id' => 1,
            'work_id' => 1,
            'person_id' => 1,
            'role' => 'Zog le Dragon'
        ));
        Actor::create(array(
            'id' => 2,
            'work_id' => 2,
            'person_id' => 2,
            'role' => 'The Terminator'
        ));
        Actor::create(array(
            'id' => 3,
            'work_id' => 3,
            'person_id' => 1,
            'role' => 'Jon Snow'
        ));
    }
}
