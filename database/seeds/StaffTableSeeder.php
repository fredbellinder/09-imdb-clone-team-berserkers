<?php
use App\Staff;
use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Staff::create(array(
            'id' => 1,
            'work_id' => 2,
            'person_id' => 3,
            'job' => 'Director'
        ));
    }
}
