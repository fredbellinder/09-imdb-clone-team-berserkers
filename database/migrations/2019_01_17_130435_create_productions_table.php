<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productions', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['series', 'movie']);
            $table->integer('movie_id')->unsigned()->nullable();
            $table->integer('series_id')->unsigned()->nullable();
            $table->integer('cast_id')->unsigned()->nullable();
            $table->integer('direction_id')->unsigned()->nullable();
            
            $table->timestamps();
            
            $table->foreign('movie_id')->references('id')->on('movies');
            $table->foreign('series_id')->references('id')->on('series');
            $table->foreign('cast_id')->references('id')->on('casts');
            $table->foreign('direction_id')->references('id')->on('directions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productions');
    }
}
