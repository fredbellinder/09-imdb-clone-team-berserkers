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
        factory(App\Watchlist::class)->states('user_id')->create();
        $watchlist = factory(App\Watchlist::class, 10)->create();
    }
}
