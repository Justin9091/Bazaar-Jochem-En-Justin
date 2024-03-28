<?php
namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function testUserLogin()
    {
        // Create a user for testing
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Prepare login data
        $loginData = [
            'email' => 'test@example.com',
            'password' => 'password',
        ];

        // Simulate a POST request to perform user login
        $response = $this->post('/login', $loginData);

        // Assert that the user is redirected after login
        $response->assertRedirect('/properties');

        // Assert that the user is correctly logged in
        $this->assertAuthenticatedAs($user);

        // Assert that the user is logged in after login
        $this->assertTrue(Auth::check());
    }

    public function testInvalidLogin()
    {
        // Prepare invalid login data
        $invalidLoginData = [
            'email' => 'invalid@example.com',
            'password' => 'invalidpassword',
        ];

        // Simulate a POST request with invalid credentials
        $response = $this->post('/login', $invalidLoginData);

        // Assert that the user is redirected back with errors
        $response->assertRedirect()->assertSessionHasErrors('email');

        // Assert that the user is not authenticated
        $this->assertGuest();
    }

    public function testUserLogout()
    {
        // Create a user for testing
        $user = User::factory()->create();

        // Acting as the authenticated user
        $this->actingAs($user);

        // Simulate a POST request to perform user logout
        $response = $this->get('/logout');

        // Assert that the user is redirected after logout
        $response->assertRedirect('/login');

        // Assert that the user is logged out
        $this->assertGuest();
    }
}
