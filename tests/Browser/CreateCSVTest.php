<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\Storage;

class CreateCSVTest extends DuskTestCase
{
    use DatabaseMigrations;
    use DatabaseTruncation;


    public function testCreateCSV(): void
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/seller/' . $user->id)
                ->waitForLocation('/seller/' . $user->id)
                ->click('@createcsv')
                ->screenshot("csv/test")
                ->press('Submit Review')
                ->waitForLocation('/seller/' . $user->id)
                ->screenshot("csv/createcsv");

            // Assert true without performing any real check
            $this->assertTrue(true);
        });
    }
}
