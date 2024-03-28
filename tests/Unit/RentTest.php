<?php
use App\Models\User;
use App\Models\advertisement\Advertisement;
use App\Models\advertisement\RentAdvertisement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class RentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateAgenda()
    {
        $user = User::factory()->create();

        // Manually create test advertisement and rent advertisements
        $advertisement = Advertisement::factory()->create([
            'type' => 'rent',
            'user_id' => $user->id,
            'title' => 'Test Advertisement',
        ]);
        RentAdvertisement::create([
            'advertisement_id' => $advertisement->id,
            'from_date' => '2024-03-01',
            'to_date' => '2024-03-10',
        ]);

        $response = $this->actingAs($user)
            ->get("/seller/{$user->id}/2024-03-01");

        $response->assertStatus(Response::HTTP_OK)
            ->assertViewIs('agenda')
            ->assertViewHas('rentingslist')
            ->assertSee('Verhuur: Test Advertisement')
            ->assertSee('Teruggave: Test Advertisement');
    }

    public function testRentItem()
    {
        $user = User::factory()->create();
        $advertisement = Advertisement::factory()->create(['user_id' => $user->id]);

        $fromDate = '2024-03-15';
        $toDate = '2024-03-20';

        $response = $this->actingAs($user)
            ->post("/advertisement/{$advertisement->id}/rentitem", [
                'fromDate' => $fromDate,
                'toDate' => $toDate,
            ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('rent', [
            'advertisement_id' => $advertisement->id,
            'from_date' => $fromDate,
            'to_date' => $toDate,
        ]);
    }
}
