<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * Tests that user can login and see the dashboard.
     *
     * @return void
     */
    public function testLogin()
    {
        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user, 'web')->get('/users');

        $response->assertSeeText('My Watchlists');
    }

    public function testUsersRedirect()
    {
        $response = $this->get('/users');

        $response->assertRedirect('/login');
    }
}
