<?php
namespace Tests\Unit;

use App\Models\advertisement\Advertisement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Session;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function testSearchMethod()
    {
        $ad = Advertisement::Factory()->create();

        $searchTerm =  $ad->title;

        // Mock a request with the search term and referer
        $response = $this->post('/search', ['search-term' => $searchTerm]);

        // Assert that the response redirects back
        $response->assertRedirect();

        // Assert that the session contains the correct values
        $this->assertEquals($searchTerm, session('search'));
    }

    public function testClearSearchMethod()
    {
        // Set up the session with some data
        $searchTerm = 'test';
        session(['search' => $searchTerm, 'page' => '1']);

        // Make a request to clear the session data
        $this->post('/search', ['search-term' => $searchTerm]);
        $response = $this->post('/clear-search');

        // Assert that the response redirects back
        $response->assertRedirect();

        // Assert that the session data is cleared
        $this->assertNull(Session::get('search'));
        $this->assertNull(Session::get('page'));
    }
}
