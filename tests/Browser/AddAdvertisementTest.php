<?php

namespace Tests\Browser;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Faker\Factory as Faker;

class AddAdvertisementTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testAddAdvertisement(): void
    {
        $user = User::factory()->create();
        $role = new Role();
        $role->name = 'business';
        $role->save();
        $user = User::factory()->create();
        $user->roles()->attach($role);

        $faker = Faker::create();

        $fakeTitle = 'testTitle';
        $fakeDescription = 'fakeDescription';
        $fakeType = 'Rent';
        $fakeExpirationDate = $faker->dateTimeBetween('+1 week', '+1 year')->format('d-m-Y');

        $this->browse(function (Browser $browser) use ($user, $fakeTitle, $fakeDescription, $fakeType, $fakeExpirationDate) {
            $browser->loginAs($user)
                ->visit(route('sellerprofile', ['userId' => $user->id]))
                ->screenshot("/advertisement/test")
                ->click('@AddAdvertisement')
                ->type('title', $fakeTitle)
                ->type('description', $fakeDescription)
                ->select('type', $fakeType)
                ->type('expiration', $fakeExpirationDate)
                ->screenshot("/advertisement/addadvertisement")
                ->press('Add Advertisement')
                ->waitForText($fakeTitle)
                ->assertSee($fakeTitle)
                ->assertSee($fakeDescription)
                ->screenshot("/advertisement/addedadvertisement");
        });
    }
}
