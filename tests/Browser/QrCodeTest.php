<?php

namespace Tests\Browser;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Illuminate\Http\UploadedFile;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class QrCodeTest extends DuskTestCase
{
    use DatabaseMigrations;
    use DatabaseTruncation;

    public function testQrCode(): void
    {
        $user = User::factory()->create();

        $role = new Role();
        $role->name = 'business';
        $role->save();

        $user->roles()->attach($role);

        $this->browse(function (Browser $browser) use ($user) {

            $browser->loginAs($user)
                ->visit('/account')
                ->assertSee($user->name)
                ->assertVisible('#qrCode');
        });
    }
}
