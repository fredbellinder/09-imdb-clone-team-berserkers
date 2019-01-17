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
        $this->call(PeopleTableSeeder::class);
        $this->call(MoviesTableSeeder::class);
        $this->call(SeriesTableSeeder::class);
        $this->call(DirectionsTableSeeder::class);
        $this->call(CastsTableSeeder::class);
        $this->call(ProductionsTableSeeder::class);
    }
}
