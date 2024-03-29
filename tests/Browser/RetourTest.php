<?php

namespace Tests\Browser;

use App\Models\advertisement\Advertisement;
use App\Models\advertisement\RentAdvertisement;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Illuminate\Http\UploadedFile;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class RetourTest extends DuskTestCase
{
    use DatabaseMigrations;
    use DatabaseTruncation;

    /**
     * A Dusk test example.
     */
    public function test_return_flow(): void
    {

        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();

            $startRent = now()->subDays(3);
            $endRent = now()->subDay();

            $ad = Advertisement::factory()->create([
                'user_id' => $user->id,
            ]);

            $rent = RentAdvertisement::create([
                'advertisement_id' => $ad->id,
                'user_id' => $user->id,
                'from_date' => $startRent,
                'to_date' => $endRent,
            ]);

            $expectedDamage = 98;
            $fakeImage = UploadedFile::fake()->image('image.jpg');
            $submitButton = __('sellersprofile.return_item_list');

            $browser->loginAs($user)
                ->visit('/seller/' . $user->id)
                ->waitFor('h2')
                ->clickLink('Return item')
                ->select('advertisementId', $ad->id)
                ->attach('image', $fakeImage)
                ->screenshot("return/return_form")
                ->press('Register return')
                ->waitFor('h2')
                ->screenshot("return/return_form_result")
                ->select('advertisement', $ad->id)
                ->press($submitButton)
                ->assertSee("Damage: " . $expectedDamage)
                ->assertSee($rent->updated_at)
                ->screenshot("return/return_result");
        });
    }
}
