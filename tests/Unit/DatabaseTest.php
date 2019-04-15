<?php

namespace Tests\Unit;

use App\Comment;
use App\Review;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseTest extends TestCase
{
    /**
     * Test ability to create a review in the database.
     *
     * @return void
     */
    public function testReviewCreation()
    {
        $comment = factory(Review::class)->create();

        $this->assertDatabaseHas('reviews', ['user_id' => 1]);
    }

    /**
     * Test ability to create a comment in the database.
     *
     * @return void
     */
    public function testCommentCreation()
    {
        $comment = factory(Comment::class)->create();

        $this->assertDatabaseHas('comments', ['user_name' => 'Daniel Salin']);
    }
}
