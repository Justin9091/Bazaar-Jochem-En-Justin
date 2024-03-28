<?php

namespace Tests\Feature;

use App\Models\advertisement\Advertisement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BidControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_happy_flow()
    {
        $ad = Advertisement::factory()->create();
        $response = $this->post('/bid/'.$ad->id);

        $response->assertStatus(302);
    }
}
