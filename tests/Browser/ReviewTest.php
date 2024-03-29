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

class ReviewTest extends DuskTestCase
{
    use DatabaseMigrations;
    use DatabaseTruncation;

    public function testPlaceReview(): void
    {
        $pageuser = User::factory()->create();
        $loginuser = User::factory()->create();

        $this->browse(function (Browser $browser) use ($pageuser, $loginuser){
            $fakeTitle = 'testTitle';
            $fakeDescription = 'fakeDescription';

            $browser->loginAs($loginuser)
                ->visit('/seller/' . $pageuser->id)
                ->screenshot("/review/kip")
                ->waitForLocation('/seller/' . $pageuser->id)
                ->assertPathIs("/seller/1")
                ->type('title', $fakeTitle)
                ->type('description', $fakeDescription)
                ->screenshot("review/addreview")
                ->press('Submit Review')
                ->waitForLocation('/seller/' . $pageuser->id)
                ->assertSee($fakeTitle)
                ->assertSee($fakeDescription)
                ->screenshot("review/addedreview");
        });
    }
}
