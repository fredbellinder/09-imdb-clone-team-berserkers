<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(WorksTableSeeder::class);
        $this->call(PeopleTableSeeder::class);
        $this->call(StaffTableSeeder::class);
        $this->call(ActorsTableSeeder::class);
    }
}
