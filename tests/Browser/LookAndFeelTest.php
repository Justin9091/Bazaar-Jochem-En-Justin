<?php

namespace Tests\Browser;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Illuminate\Http\UploadedFile;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LookAndFeelTest extends DuskTestCase
{
    use DatabaseMigrations;
    use DatabaseTruncation;

    public function testUploadImage(): void
    {
        $user = User::factory()->create();

        $role = new Role();
        $role->name = 'business';
        $role->save();

        $user->roles()->attach($role);

        $this->browse(function (Browser $browser) use ($user) {
            $img = UploadedFile::fake()->image('avatar.jpg');

            $browser->loginAs($user)
                ->visit('/account')
                ->assertSee($user->name)
                ->assertSee('Look and feel')
                ->assertSee('Short URL')
                ->assertSee('QR Code')
                ->assertSee('Favorites')
                // Test uploading an image
                ->attach('image', $img) // Change the path to your test image
                ->press('Upload')
                ->assertSee('Uploaded image')
                ->type('short_url', 'new-short-url')
                ->press('Upload')
                ->assertSee($img)
                ->screenshot("/account/custom_image_uploaded");
        });
    }
}
