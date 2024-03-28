<?php

namespace Tests\Unit\Controllers;

use App\Http\Controllers\ShortUrlController;
use App\Models\ShortUrl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Http\Requests\ShortenUrlRequest;
class ShortUrlControllerTest extends TestCase
{
    use RefreshDatabase; // This trait resets the database after each test
    public function testEditMethodStoresShortUrl()
    {
        // Mock Auth::getUser() to return a user instance
        Auth::shouldReceive('getUser')->andReturn((object)['id' => 1]);

        $controller = new ShortUrlController();

        // Create a mock instance of ShortenUrlRequest
        $request = $this->getMockBuilder(ShortenUrlRequest::class)
            ->disableOriginalConstructor()
            ->getMock();
        $request->expects($this->once())
            ->method('validated')
            ->willReturn(['short_url' => 'example']);

        // Call the edit method
        $response = $controller->edit($request);

        // Assert that the response is a redirect
        $this->assertInstanceOf(RedirectResponse::class, $response);

        // Assert that the short URL was stored in the database
        $this->assertDatabaseHas('short_urls', [
            'seller_id' => 1,
            'short_url' => 'example',
        ]);

        // Assert that the redirect URL is 'http://localhost/account'
        $this->assertEquals('http://localhost/account', $response->getTargetUrl());
    }

    public function testUrlMethodRedirectsToSellerAccount()
    {
        // Create a short URL in the database
        ShortUrl::create(['seller_id' => 1, 'short_url' => 'example']);

        $controller = new ShortUrlController();

        // Call the url method with the short URL parameter
        $response = $controller->url('example');

        // Assert that the response is a redirect
        $this->assertInstanceOf(RedirectResponse::class, $response);

        // Assert that the redirect URL is 'http://localhost/seller/1'
        $this->assertEquals('http://localhost/seller/1', $response->getTargetUrl());
    }

    public function testUrlMethodRedirectsToHomeForInvalidShortUrl()
    {
        $controller = new ShortUrlController();

        // Call the url method with an invalid short URL parameter
        $response = $controller->url('invalid');

        // Assert that the response is a redirect
        $this->assertInstanceOf(RedirectResponse::class, $response);

        // Assert that the redirect URL is 'http://localhost'
        $this->assertEquals('http://localhost', $response->getTargetUrl());
    }
}
