<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWatchlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watchlists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('poster_url');
            $table->integer('user_id')->unsigned();
            $table->string('content');
            $table->integer('movie_tmdb_id')->nullable()->unisgned();
            $table->integer('series_tmdb_id')->nullable()->unisgned();
            $table->date('year')->nullable()->unisgned();
            $table->timestamps();
             
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('watchlists');
    }
}
