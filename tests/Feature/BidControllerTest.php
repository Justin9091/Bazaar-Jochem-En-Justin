<?php

namespace Tests\Feature;

use App\Models\advertisement\Advertisement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BidControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_happy_flow()
    {
        $ad = Advertisement::factory()->create(
            ['expires_at' => now()->addDays(1)]
        );
        $response = $this->post('/bid/'.$ad->id);

        $response->assertStatus(302);
    }

    public function test_user_has_4_bids()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $ad = Advertisement::factory()->create(
            ['expires_at' => now()->addDays(1)]
        );
        $ad->user = $user;

        $user->bids()->create(['advertisement_id' => $ad->id, 'bid' => 100]);
        $user->bids()->create(['advertisement_id' => $ad->id, 'bid' => 200]);
        $user->bids()->create(['advertisement_id' => $ad->id, 'bid' => 300]);
        $user->bids()->create(['advertisement_id' => $ad->id, 'bid' => 400]);

        $response = $this->post('/bid/'.$ad->id, ['bid' => 500]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('bid');
    }

    public function test_advertisement_has_expired()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $ad = Advertisement::factory()->create([
            'expires_at' => now()->subDays(5)
        ]);
        $ad->user = $user;
        $response = $this->post('/bid/'.$ad->id);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('bid');
    }

    public function test_bid_is_not_higher_than_highest_bid()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $ad = Advertisement::factory()->create(
            ['expires_at' => now()->addDays(1)]
        );
        $ad->user = $user;

        $ad->bids()->create(['user_id' => $ad->user->id, 'bid' => 500]);
        $response = $this->post('/bid/'.$ad->id, ['bid' => 400]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('bid', "Your bid must be higher than the current highest bid");
    }

    public function test_bid_is_higher_than_highest_bid()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $ad = Advertisement::factory()->create(
            ['expires_at' => now()->addDays(1)]
        );
        $ad->user = $user;

        $ad->bids()->create(['user_id' => $ad->user->id, 'bid' => 500]);
        $response = $this->post('/bid/'.$ad->id, ['bid' => 600]);

        $response->assertStatus(302);
    }
}
