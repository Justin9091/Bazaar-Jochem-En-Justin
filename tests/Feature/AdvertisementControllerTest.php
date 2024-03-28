<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdvertisementControllerTest extends TestCase
{

    public function test_happy_flow()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $advertisement = \App\Models\advertisement\Advertisement::factory()->create([
            'user_id' => $user->id
        ]);
        $response = $this->get('/advertisement/'.$advertisement->id);

        $response->assertStatus(200);
    }
}
