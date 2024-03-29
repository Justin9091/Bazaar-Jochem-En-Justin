<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ImportCSVTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testImportCsv(): void
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            // Upload CSV file
            $browser->loginAs($user)
                ->visit('/seller/' . $user->id)
                ->attach('csv_file', storage_path('app/csv_imports/file.csv'))
                ->press('@importcsv')
                ->waitForLocation('/seller/' . $user->id)
                ->assertPathIs('/seller/' . $user->id);
        });
    }
}
