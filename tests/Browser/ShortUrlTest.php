<?php

namespace Tests\Browser;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Illuminate\Http\UploadedFile;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ShortUrlTest extends DuskTestCase
{
    use DatabaseMigrations;
    use DatabaseTruncation;

    public function testExample(): void
    {
        $user = User::factory()->create();

        $role = new Role();
        $role->name = 'business';
        $role->save();

        $user->roles()->attach($role);

        $this->browse(function (Browser $browser) use ($user) {

            $browser->loginAs($user)
                ->visit('/account')
                ->type('short_url', 'new-short-url')
                ->screenshot('account/short_url_filled_form')
                ->press('@new_short_url')
                ->assertSee(__('account.go_to_page'))
                ->screenshot('account/short_url_created')
                ->clickLink(__('account.go_to_page'))
                ->assertUrlIs(env('APP_URL'). 'seller/' . $user->id);
        });
    }
}
