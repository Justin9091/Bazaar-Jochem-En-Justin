<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase; // Reset the database after each test

    public function testUserRegistration()
    {
        $this->assertDatabaseMissing('roles', ['name' => 'individual']);
        $this->assertDatabaseMissing('roles', ['name' => 'business']);
        if (Role::where('name', 'individual')->doesntExist()) {
            Role::create(['name' => 'individual']);
        }

        if (Role::where('name', 'business')->doesntExist()) {
            Role::create(['name' => 'business']);
        }
        // Prepare user registration data
        $userData = [
            'email' => 'test@example.com',
            'first-name' => 'John',
            'infix' => 'van',
            'last-name' => 'Doe',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'place-ads' => "on",
            'account-type' => 'individual',
        ];

        // Simulate a POST request to store the user registration
        $response = $this->post('/register', $userData);

        // Assert that the user is redirected after registration
        $response->assertRedirect();

        // Assert that the user is correctly created in the database
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'name' => 'John van Doe',
        ]);

        // Retrieve the created user from the database
        $user = User::where('email', 'test@example.com')->first();

        // Assert that the user has a valid API token
        $this->assertNotNull($user->api_token);

        // Assert that the user is logged in after registration
        $this->assertTrue(Auth::check());
    }
}
