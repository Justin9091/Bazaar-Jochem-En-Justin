<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    use DatabaseTruncation;

    public function test_login(): void
    {
        $user = User::factory()->create([
            'email' => 'john.doe@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->type('email', $user->email)
                    ->type('password', 'password')
                    ->press('Login');

            $browser->assertPathIs('/');
            $browser->assertAuthenticatedAs($user);
        });
    }

    public function test_login_with_invalid_data(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->type('email', '')
                    ->type('password', '')
                    ->press('Login');

            $browser->assertSee('The provided credentials do not match our records.');
        });
    }
}
