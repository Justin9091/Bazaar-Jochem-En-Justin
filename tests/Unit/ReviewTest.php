<?php

namespace Tests\Unit;

use App\Models\advertisement\Advertisement;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    public function testAddReviewWithValidData()
    {
        // Create a user for testing
        $user = User::factory()->create();
        $ad = Advertisement::factory()->create();

        // Create valid review data
        $inputData = [
            'user_id' => $user->id,
            'advertisement_id' => $ad->id,
            'title' => 'Great Product',
            'description' => 'This product is amazing!',
            'score' => 5,
            'name' => $user->name
        ];

        $reviewData = [
            'user_id' => $user->id,
            'advertisement_id' => $ad->id,
            'title' => 'Great Product',
            'description' => 'This product is amazing!',
            'score' => 5,
            'reviewer' => $user->name
        ];

        // Make a POST request to add the review
        $response = $this->post('/add-reviews', $inputData);

        // Assert that the review was successfully added
        $response->assertRedirect();

        // Assert that the review exists in the database
        $this->assertDatabaseHas('reviews', $reviewData);
    }

    public function testAddReviewWithMissingName()
    {
        // Create a user for testing
        $user = User::factory()->create();
        $ad = Advertisement::factory()->create();
        $this->actingAs($user);

        // Create valid review data with missing name
        $inputData = [
            'user_id' => $user->id,
            'advertisement_id' => $ad->id,
            'title' => 'Great Product',
            'description' => 'This product is amazing!',
            'score' => 5,
        ];
        $reviewData = [
            'user_id' => $user->id,
            'advertisement_id' => $ad->id,
            'title' => 'Great Product',
            'description' => 'This product is amazing!',
            'score' => 5,
            'reviewer' => $user->name
        ];

        // Make a POST request to add the review
        $response = $this->post('/add-reviews', $inputData);

        // Assert that the review was successfully added
        $response->assertRedirect();

        // Assert that the review exists in the database with the user's name
        $this->assertDatabaseHas('reviews', $reviewData);
    }
}
