<?php

namespace Tests\Unit;

use App\Http\Controllers\SellerController;
use App\Models\advertisement\Advertisement;
use App\Models\Component;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SellerTest extends TestCase
{
    use RefreshDatabase;

    public function testShowMethodReturnsCorrectViewWithData()
    {
        $user = User::factory()->create();
        $userId = $user->id;

        // Create a single Component instance for testing
        $component = Component::create([
            'order' => 1,
            'type' => 'text-component',
            'property' => '{"text":"fewfew","size":"23"}',
            'user_id' => $userId,
        ]);

        // Mock the storage facade
        Storage::fake('public');
        $fileName = $userId . '.png';
        Storage::put('/public/logos/' . $fileName, '');

        // Call the show method
        $response = $this->get(route('sellerprofile', ['userId' => $userId]));

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert that the view is 'sellerprofile'
        $response->assertViewIs('sellerprofile');

        // Assert that the view contains the correct data
        $response->assertViewHas('user', $user);
        $response->assertViewHas('components');
        $response->assertViewHas('userid', $userId);
        //$response->assertViewHas('logo', Storage::url('public/logos/' . $fileName));
    }

    public function testCreateAdvertisementMethodCreatesAdvertisementAndRedirects()
    {

        $user = User::factory()->create();
        $userId = $user->id;

        $this->actingAs($user);

        // Mock the validated data
        $expirationDate = now()->addDays(30);
        $validatedData = [
            'title' => 'Test Advertisement',
            'description' => 'This is a test advertisement.',
            'type' => 'Huur', // Make sure this matches the expected format in your application
            'expiration' => $expirationDate,
        ];

        // Mock the CreateAdvertisementRequest
        $request = $this->mock(\App\Http\Requests\CreateAdvertisementRequest::class);
        $request->shouldReceive('validated')->andReturn($validatedData);

        // Call the createadvertisement method
        $controller = new SellerController();
        $response = $controller->createadvertisement($request, $userId);

        // Assert that the response is a redirect
        $this->assertInstanceOf(RedirectResponse::class, $response);

        // Assert that the advertisement was created with the correct data
        $this->assertDatabaseHas('advertisements', [
            'user_id' => $userId,
            'title' => 'Test Advertisement',
            'description' => 'This is a test advertisement.',
            'type' => 'rent',
            'expires_at' => $expirationDate,
        ]);

        // Assert that the redirect route is correct
        $this->assertEquals(route('sellerprofile', ['userId' => $userId]), $response->getTargetUrl());
    }
}
