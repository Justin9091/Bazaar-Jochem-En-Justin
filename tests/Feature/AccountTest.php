<?php

namespace Tests\Feature;

use App\Models\advertisement\Advertisement;
use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_test_200()
    {
        $this->actingAs($user = User::factory()->create());
        $response = $this->get('/account');

        $response->assertStatus(200);
    }

    public function test_favorite_ads()
    {
        $favAd = new Advertisement();
        $favAd->user_id = 1;
        $favAd->id = 1;
        $favAd->title = 'Test Ad';
        $favAd->type = 'rent';
        $favAd->expires_at = '2021-12-12';
        $favAd->description = 'Test Description';

        $this->actingAs($user = User::factory()->create());
        $user->favorites()->save($favAd);

        $response = $this->get('/account');
        $response->assertViewHas('favoriteAds');
    }

    public function test_short_url()
    {
        $shortUrl = new ShortUrl();
        $shortUrl->seller_id = 1;
        $shortUrl->short_url = 'http://test.com';

        $this->actingAs($user = User::factory()->create());
        $shortUrl->save();

        $response = $this->get('/account');
        $response->assertViewHas('url');
    }

    public function test_custom_logo()
    {
        $this->actingAs($user = User::factory()->create());
        $user->id = 1;
        $user->save();

        $response = $this->get('/account');
        $response->assertViewHas('logo');
    }
}
