<?php

namespace Tests\Feature;

use App\Models\advertisement\Advertisement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FavoriteControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_favorite()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $advertisement = Advertisement::factory()->create();

        $response = $this->get('/favorite/'.$advertisement->id);

        $response->assertStatus(302);

        $this->assertDatabaseHas('user_favorites', [
            'user_id' => $user->id,
            'advertisement_id' => $advertisement->id
        ]);
    }

    public function test_unfavorite()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $advertisement = Advertisement::factory()->create();

        $user->favorites()->create(['advertisement_id' => $advertisement->id]);

        $response = $this->get('/favorite/'.$advertisement->id);

        $response->assertStatus(302);

        $this->assertDatabaseMissing('user_favorites', [
            'user_id' => $user->id,
            'advertisement_id' => $advertisement->id
        ]);
    }
}
