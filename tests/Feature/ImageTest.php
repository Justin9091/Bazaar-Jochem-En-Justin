<?php

namespace Tests\Feature;

use App\Http\Controllers\ImageController;
use App\Http\Requests\ImageRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStore()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Mocking the ImageRequest
        $request = $this->mockImageRequest();

        // Mocking the uploaded file
        $file = UploadedFile::fake()->image('test-image.jpg');

        // Call the store method
        $controller = new ImageController();
        $response = $controller->store($request, 'logos', $user->id, $file);

        // Assert the response is a redirect
        $this->assertNotNull($response);

        // Assert that the image is stored
        Storage::disk('public')->assertExists("logos/{$user->id}.jpg");
    }

    // Helper function to mock the ImageRequest
    private function mockImageRequest()
    {
        $request = $this->getMockBuilder(ImageRequest::class)
            ->disableOriginalConstructor()
            ->getMock();

        $request->expects($this->once())
            ->method('hasFile')
            ->willReturn(true);

        $request->expects($this->once())
            ->method('file')
            ->willReturn(UploadedFile::fake()->image('test-image.jpg'));

        return $request;
    }
}
