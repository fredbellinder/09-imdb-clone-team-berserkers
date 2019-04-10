<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MovieTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFightClubRoute()
    {
        $response = $this->get('/movies/550');

        $response->assertStatus(200);

        $response->assertSeeText('Fight Club');
    }
}
