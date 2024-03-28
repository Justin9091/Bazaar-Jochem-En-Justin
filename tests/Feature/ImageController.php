<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ImageController extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $file = UploadedFile::fake()->image('logo.jpg');

        $response = $this->post(route('image', ['folder' => 'logos', 'name' => $user->id]), [
            'image' => $file
        ]);

        $response->assertStatus(302);

        $this->assertFileExists(storage_path('app/public/logos/' . $user->id . '.jpg'));
    }
}
