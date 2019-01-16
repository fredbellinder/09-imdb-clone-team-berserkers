<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('movie_id')->unsigned();
            $table->integer('series_id')->unsigned();
            $table->string('title');
            $table->enum('type', ['series', 'movie']);
            $table->year('year');
            $table->string('country');
            $table->string('imdb_id');
            $table->string('genre');
            $table->string('runtime');
            
            $table->timestamps();

            $table->foreign('series_id')->references('id')->on('series');
            $table->foreign('movie_id')->references('id')->on('movies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media');
    }
}
