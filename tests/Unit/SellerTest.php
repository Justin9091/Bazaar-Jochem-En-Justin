<?php

namespace Tests\Unit\Controllers;

use App\Http\Controllers\SellerController;
use App\Models\advertisement\Advertisement;
use App\Models\Component;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SellerControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShowMethodReturnsCorrectViewWithData()
    {
        $userId = 1;

        // Mock User, Advertisement, and Component data
        $user = User::create([
            'id' => $userId,
            'name' => 'Test User',
            'email' => 'test@test.nl',
            'password' => 'test',
        ]);

        // Create a single Component instance for testing
        $component = Component::create([
            'order' => 1,
            'type' => 'text-component',
            'property' => 'text-property',
            'user_id' => $userId,
        ]);

        // Mock the storage facade
        Storage::fake('public');
        $fileName = 'user_' . $userId . '.png';
        Storage::put('logos/' . $fileName, '');

        // Call the show method
        $controller = new SellerController();
        $response = $controller->show($userId);

        // Assert that the response is the correct view
        $response->assertViewIs('sellerprofile');

        // Assert that the view contains the correct data
        $response->assertViewHas('user', $user);
        $response->assertViewHas('components', collect([$component])); // Pass the component as a collection
        $response->assertViewHas('userid', $userId);
        $response->assertViewHas('logo', Storage::url('logos/' . $fileName));
    }

    public function testCreateAdvertisementMethodCreatesAdvertisementAndRedirects()
    {
        $userId = 1;

        // Mock the request data
        $requestData = [
            'title' => 'Test Advertisement',
            'description' => 'This is a test advertisement.',
            'type' => 'rent',
            'expires_at' => now()->addDays(30),
            'user_id' => $userId,
            'bought_user_id' => '2',
        ];

        // Create a new request object with the data
        $request = new Request($requestData);

        // Call the createadvertisement method
        $controller = new SellerController();
        $response = $controller->createadvertisement($request, $userId);

        // Assert that the response is a redirect
        $this->assertInstanceOf(RedirectResponse::class, $response);

        // Assert that the advertisement was created
        $this->assertDatabaseHas('advertisements', [
            'user_id' => $userId,
            'title' => 'Test Advertisement',
            'description' => 'This is a test advertisement.',
            'type' => 'rent', // Converted from 'Huur'
        ]);

        // Assert that the redirect route is correct
        $this->assertEquals(route('sellerprofile', ['userId' => $userId]), $response->getTargetUrl());
    }
}
