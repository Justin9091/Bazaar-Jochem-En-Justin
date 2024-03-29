<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SearchTest extends DuskTestCase
{
    use DatabaseMigrations;
    use DatabaseTruncation;

    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->type('search-term', 'search-term')
                ->screenshot('search/filled_form')
                ->press('Search')
                ->screenshot('search/search_results')
                ->waitFor('#clear-search')
                ->assertVisible('#clear-search');
        });
    }
}
