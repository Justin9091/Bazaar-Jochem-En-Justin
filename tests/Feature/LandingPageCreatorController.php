<?php

namespace Tests\Feature;

use App\Models\Component;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LandingPageCreatorController extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_add_component()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $type = "TEXT";
        $property = "{
            \"text\": \"Hello World\",
            \"size\": \"12\"
        }";

        Component::created(p);
    }
}
