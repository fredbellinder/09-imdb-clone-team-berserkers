<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<< HEAD
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('headline');
            $table->string('content');
            $table->integer('movie_tmdb_id')->unsigned();
            $table->string('movie_title');
            $table->integer('rating')->nullable()->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
=======
        Schema::create(
            'reviews',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('headline');
                $table->string('content');
                $table->integer('movie_tmdb_id')->nullable()->unsigned();
                $table->integer('rating')->nullable()->unsigned();
                $table->integer('user_id')->unsigned();
                $table->timestamps();
>>>>>>> :bug: Fix the duplicate entries of movies on watchlists
             
                $table->foreign('user_id')->references('id')->on('users');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
