<?php

use Illuminate\Database\Seeder;

class WatchlistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $watchlist = factory(App\Watchlist::class, 5)->create();
    }
}
