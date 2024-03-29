<?php

namespace Tests\Feature;

use App\Models\advertisement\Advertisement;
use App\Models\advertisement\RentAdvertisement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RetourControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShowMethod()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create test advertisement
        $advertisement = Advertisement::factory()->create([
            'type' => 'rent',
            'user_id' => $user->id
        ]);

        // Create test rents associated with the advertisement
        $rents = [];
        for ($i = 0; $i < 3; $i++) {
            $rent = new RentAdvertisement([
                'advertisement_id' => $advertisement->id,
                'from_date'=> Carbon::parse('03/03/2024')->format('Y-m-d'),
                'to_date'=> Carbon::parse('12/12/2024')->format('Y-m-d'),
                'damage'=> '1',
            ]);
            $rent->save();
            $rents[] = $rent;
        }

        // Follow the redirect to get the view
        $response = $this->post("/return/list", ['advertisement' => $advertisement->id]);

        // Assert the view is returned
        $response->assertStatus(200);

        // Assert data is passed to the view
        $response->assertViewHas('advertisement', $advertisement);
        $response->assertViewHas('returns');
    }

    public function testReturnItemMethod()
    {
        // Create test user and advertisements
        $user = \App\Models\User::factory()->create();
        $advertisements = Advertisement::factory(2)->create(['user_id' => $user->id, 'type' => 'rent']);

        // Authenticate the user
        $this->actingAs($user);

        // Call the returnItem method
        $response = $this->get('/return');

        // Assert response is successful and view is returned
        $response->assertStatus(200)->assertViewIs('return');

        // Assert data is passed to the view
        $response->assertViewHas('advertisements', function ($viewAdvertisements) use ($advertisements) {
            return count($viewAdvertisements) === count($advertisements);
        });
    }

    public function testStoreReturnedItemMethod()
    {
        $this->refreshDatabase();

        // Create a user
        $user = User::factory()->create();

        // Create a test advertisement
        $advertisement = Advertisement::factory()->create(['user_id' => $user->id]);

        // Create a test rent associated with the advertisement
        $rent = RentAdvertisement::create([
            'advertisement_id' => $advertisement->id,
            'from_date'=> '2024-03-03',
            'to_date'=> '2024-12-12',
            'damage'=> '10',
        ]);

        // Authenticate as the user
        $this->actingAs($user);

        // Mock file upload
        $filename = 'returnedItem.jpg';
        $file = UploadedFile::fake()->image($filename);

        // Simulate an HTTP POST request to the storeReturnedItem route
        $response = $this->post(route('return.store'), [
            'advertisementId' => $advertisement->id,
            'image' => $file
        ]);

        // Assert that the response is a redirect
        $response->assertRedirect();

        // Assert that the file was stored in the real storage
        Storage::disk('public')->assertExists('images/returnedItems/' . $file->hashName());

        // Assert that the rent advertisement's image was updated in the database
        $this->assertDatabaseHas('rent', [
            'id' => $rent->id,
            'image' => $file->hashName()
        ]);
    }
}
