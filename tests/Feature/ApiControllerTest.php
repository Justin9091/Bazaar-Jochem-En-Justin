<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_reviews_unkownApiToken()
    {
        $unexistingApiToken = '123456789';
        $response = $this->get('/api/reviews/'.$unexistingApiToken);

        $response->assertStatus(401);
        $response->assertJson(['error' => 'Invalid API token']);
    }

    public function test_getReviews()
    {
        $user = \App\Models\User::factory()->create();
        $response = $this->get('/api/reviews/'.$user->api_token);

        $response->assertStatus(200);
    }

    public function test_advertisements_unkownApiToken()
    {
        $unexisting = '123456789';
        $response = $this->get('/api/advertisements/'.$unexisting);

        $response->assertStatus(401);
        $response->assertJson(['error' => 'Invalid API token']);
    }

    public function test_getAdvertisements()
    {
        $user = \App\Models\User::factory()->create();
        $response = $this->get('/api/advertisements/'.$user->api_token);

        $response->assertStatus(200);
    }

    public function test_advertisements_reviews_unkownApiToken()
    {
        $unexisting = '123456789';
        $response = $this->get('/api/advertisements-reviews/'.$unexisting);

        $response->assertStatus(401);
        $response->assertJson(['error' => 'Invalid API token']);
    }

    public function test_getAdvertisementsAndReviews()
    {
        $user = \App\Models\User::factory()->create();
        $response = $this->get('/api/advertisements-reviews/'.$user->api_token);

        $response->assertStatus(200);
    }
}
