<?php
namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LanguageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testLanguageSwitch()
    {
        // Create a user for testing
        $user = User::factory()->create();

        // Acting as the authenticated user
        $this->actingAs($user);

        // Create a request with a valid locale
        $response = $this->post('/language', ['locale' => 'en']);

        // Assert that the response is a redirect
        $response->assertRedirect();

        // Assert that the locale is set in the session
        $this->assertEquals('en', session('locale'));
    }

    public function testInvalidLanguageSwitch()
    {
        // Create a user for testing
        $user = User::factory()->create();

        // Acting as the authenticated user
        $this->actingAs($user);

        // Create a request with an invalid locale
        $response = $this->post('/language', ['locale' => 'invalid']);

        // Assert that the response is a redirect back
        $response->assertRedirect();

        // Assert that the session locale remains unchanged
        $this->assertNull(session('locale'));
    }
}
