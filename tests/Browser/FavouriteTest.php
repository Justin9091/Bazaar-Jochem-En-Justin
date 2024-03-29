<?php

namespace Tests\Browser;

use App\Models\advertisement\Advertisement;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FavouriteTest extends DuskTestCase
{
    use DatabaseMigrations;
    use DatabaseTruncation;

    public function testExample(): void
    {
        $user = User::factory()->create();

        $ad = Advertisement::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('advertisements', [
            'title' => $ad->title,
        ]);

        $this->browse(function (Browser $browser) use ($user, $ad) {

            $browser->loginAs($user)
                ->visit('/')
                ->screenshot('favorite/initial')
                ->click('@favoriteStar')
                ->pause(1000)
                ->screenshot('favorite/favorite')
                ->visit('/account')
                ->screenshot('favorite/favorites')
                ->click('@favoriteStar')
                ->refresh()
                ->screenshot('favorite/un-favorite')
                ->assertDontSee($ad->title);
        });
    }
}
