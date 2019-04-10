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
        $user = factory(User::class)->make();

        $this->actingAs($user)->assertAuthenticated();
    }

    public function testUsersRedirect()
    {
        $response = $this->get('/users');

        $response->assertRedirect('/login');
    }

    public function testWatchlists()
    {
        $user = factory(User::class)->make();

        $this->actingAs($user)->get('/watchlists')->assertOk();
    }
    
    public function testDashboardAsAdmin()
    {
        $user = factory(User::class)->make([
            'role_id' => 1
        ]);

        $this->actingAs($user)->get('/users')->assertSeeText('Administrate Reviews');
    }

    public function testDashboardAsUser()
    {
        $user = factory(User::class)->make();

        $this->actingAs($user)->get('/users')->assertOk();
    }
}
