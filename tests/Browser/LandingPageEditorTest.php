<?php

namespace Tests\Browser;

use App\enum\ComponentType;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Illuminate\Http\UploadedFile;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LandingPageEditorTest extends DuskTestCase
{
    use DatabaseMigrations;
    use DatabaseTruncation;

    public function test_add_text_component(): void
    {
        $user = User::factory()->create();

        $role = new Role();
        $role->name = 'business';
        $role->save();

        $user->roles()->attach($role);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/landing/editor')
                ->assertSee('Add Component')
                ->select('type', 'text-component')
                ->screenshot('editor/selected_text_component')
                ->type('@text-input', 'Hello World')
                ->type('size', '20')
                ->screenshot('editor/filled_text_component_form')
                ->press('@add-component')
                ->screenshot('editor/submitted_text_component_form')
                ->assertSee('Hello World');
        });
    }

    public function test_add_image_component(): void
    {
        $user = User::factory()->create();

        $role = new Role();
        $role->name = 'business';
        $role->save();

        $user->roles()->attach($role);

        $this->browse(function (Browser $browser) use ($user) {
            $fakeImage = UploadedFile::fake()->image('test.jpg');

            $browser->loginAs($user)
                ->visit('/landing/editor')
                ->assertSee('Add Component')
                ->select('type', 'image-component')
                ->screenshot('editor/selected_image_component')
                ->attach('image', $fakeImage)
                ->type('description', "This is a test image")
                ->screenshot('editor/filled_image_component_form')
                ->press('@add-component')
                ->screenshot('editor/submitted_image_component_form')
                ->assertSee($fakeImage);
        });
    }

    // Test move up
    public function test_move_up_component(): void
    {
        $user = User::factory()->create();

        $role = new Role();
        $role->name = 'business';
        $role->save();

        $user->roles()->attach($role);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/landing/editor')
                ->assertSee('Add Component')
                ->select('type', 'text-component')
                ->type('@text-input', 'Hello World')
                ->type('size', '20')
                ->press('@add-component')
                ->select('type', 'text-component')
                ->type('@text-input', 'Hello World 2')
                ->type('size', '20')
                ->press('@add-component')
                ->screenshot('editor/added_two_text_components')
                ->press('@move-up')
                ->screenshot('editor/moved_up_text_component')
                ->assertSeeIn('.component:nth-child(2)', 'Hello World 2')
                ->assertSeeIn('.component:nth-child(1)', 'Hello World');
        });
    }

    // Test move down
    public function test_move_down_component(): void
    {
        $user = User::factory()->create();

        $role = new Role();
        $role->name = 'business';
        $role->save();

        $user->roles()->attach($role);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/landing/editor')
                ->assertSee('Add Component')
                ->select('type', 'text-component')
                ->type('@text-input', 'Hello World')
                ->type('size', '20')
                ->press('@add-component')
                ->select('type', 'text-component')
                ->type('@text-input', 'Hello World 2')
                ->type('size', '20')
                ->press('@add-component')
                ->screenshot('editor/added_two_text_components')
                ->press('@move-down')
                ->screenshot('editor/moved_down_text_component')
                ->assertSeeIn('.component:nth-child(1)', 'Hello World 2')
                ->assertSeeIn('.component:nth-child(2)', 'Hello World');
        });
    }

    // Test delete
    public function test_delete_component(): void
    {
        $user = User::factory()->create();

        $role = new Role();
        $role->name = 'business';
        $role->save();

        $user->roles()->attach($role);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/landing/editor')
                ->assertSee('Add Component')
                ->select('type', 'text-component')
                ->type('@text-input', 'Hello World')
                ->type('size', '20')
                ->press('@add-component')
                ->screenshot('editor/added_text_component')
                ->press('@delete')
                ->screenshot('editor/deleted_text_component')
                ->assertDontSee('Hello World');
        });
    }
}
