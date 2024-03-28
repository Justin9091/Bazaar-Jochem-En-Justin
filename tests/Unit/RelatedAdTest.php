<?php
use App\Models\advertisement\Advertisement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class RelatedAdControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testAddRelatedAd()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create base advertisement
        $baseAdvertisement = Advertisement::factory()->create();

        // Create related advertisement
        $relatedAdvertisement = Advertisement::factory()->create();

        // Send POST request to add related ad
        $response = $this->post('/related/add/' . $baseAdvertisement->id,[
            'related_ad_id' => $relatedAdvertisement->id,
        ]);

        // Assert the response
        $response->assertRedirect();

        // Check if the related ad is attached to the base ad
        $this->assertDatabaseHas('related_ads', [
            'advertisement_id' => $baseAdvertisement->id,
            'related_ad_id' => $relatedAdvertisement->id,
        ]);
    }

    public function testRemoveRelatedAd()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create base advertisement
        $baseAdvertisement = Advertisement::factory()->create();

        // Create related advertisement
        $relatedAdvertisement = Advertisement::factory()->create();

        // Attach related ad to the base ad
        $baseAdvertisement->relatedAds()->attach($relatedAdvertisement);

        // Send GET request to remove related ad
        $response = $this->get(route('related.remove', [
            'baseAdvertisementId' => $baseAdvertisement->id,
            'relatedAdvertisementId' => $relatedAdvertisement->id,
        ]));

        // Assert the response
        $response->assertRedirect();

        // Check if the related ad is detached from the base ad
        $this->assertDatabaseMissing('related_ads', [
            'advertisement_id' => $baseAdvertisement->id,
            'related_ad_id' => $relatedAdvertisement->id,
        ]);
    }
}
