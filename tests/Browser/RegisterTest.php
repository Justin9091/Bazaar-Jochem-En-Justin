<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{

    use DatabaseMigrations;
    use DatabaseTruncation;

    public function testRegister(): void
    {
        $user = User::factory()->make();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/register')
                ->assertSee('Register')
                ->type('@first', "John")
                ->type('@infix', "van")
                ->type('@last', "Doe")
                ->type('@email', $user->email)
                ->type('@password', 'Password123!')
                ->type('@password-confirmation', 'Password123!');

            $browser->click('@submit-button')
                ->waitForRoute('home');

            $browser->assertDontSee('The first-name field is required.');
            $browser->assertDontSee('The last-name field is required.');
            $browser->assertDontSee('The email field is required.');
            $browser->assertDontSee('The password field is required.');

            $browser->assertRouteIs('home');
            $browser->assertAuthenticated();
        });
    }

    public function testRegisterWithInvalidData(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->assertSee('Register')
                ->type('@first', "")
                ->type('@infix', "")
                ->type('@last', "")
                ->type('@email', "")
                ->type('@password', '')
                ->type('@password-confirmation', '');

            $browser->click('@submit-button')
                ->waitForText('The first-name field is required.')
                ->waitForText('The last-name field is required.')
                ->waitForText('The email field is required.')
                ->waitForText('The password field is required.');

            $browser->assertSee('The first-name field is required.');
            $browser->assertSee('The last-name field is required.');
            $browser->assertSee('The email field is required.');
            $browser->assertSee('The password field is required.');
        });
    }

    public function test_place_ads() {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->assertSee('Register')
                ->click('@place-ads');

            $browser->assertSee('Individual');
            $browser->assertSee('Business');
        });
    }

}
