<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class BedrijfTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateBedrijf()
    {
        $admin = factory('App\User', 'admin')->create();
        $bedrijf = factory('App\Bedrijf')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $bedrijf) {
            $browser->loginAs($admin)
                ->visit(route('admin.bedrijfs.index'))
                ->clickLink('Add new')
                ->type("bedrijfsnaam", $bedrijf->bedrijfsnaam)
                ->select("achternaam_id", $bedrijf->achternaam_id)
                ->press('Save')
                ->assertRouteIs('admin.bedrijfs.index')
                ->assertSeeIn("tr:last-child td[field-key='bedrijfsnaam']", $bedrijf->bedrijfsnaam)
                ->assertSeeIn("tr:last-child td[field-key='achternaam']", $bedrijf->achternaam->achternaam);
        });
    }

    public function testEditBedrijf()
    {
        $admin = factory('App\User', 'admin')->create();
        $bedrijf = factory('App\Bedrijf')->create();
        $bedrijf2 = factory('App\Bedrijf')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $bedrijf, $bedrijf2) {
            $browser->loginAs($admin)
                ->visit(route('admin.bedrijfs.index'))
                ->click('tr[data-entry-id="' . $bedrijf->id . '"] .btn-info')
                ->type("bedrijfsnaam", $bedrijf2->bedrijfsnaam)
                ->select("achternaam_id", $bedrijf2->achternaam_id)
                ->press('Update')
                ->assertRouteIs('admin.bedrijfs.index')
                ->assertSeeIn("tr:last-child td[field-key='bedrijfsnaam']", $bedrijf2->bedrijfsnaam)
                ->assertSeeIn("tr:last-child td[field-key='achternaam']", $bedrijf2->achternaam->achternaam);
        });
    }

    public function testShowBedrijf()
    {
        $admin = factory('App\User', 'admin')->create();
        $bedrijf = factory('App\Bedrijf')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $bedrijf) {
            $browser->loginAs($admin)
                ->visit(route('admin.bedrijfs.index'))
                ->click('tr[data-entry-id="' . $bedrijf->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='bedrijfsnaam']", $bedrijf->bedrijfsnaam)
                ->assertSeeIn("td[field-key='achternaam']", $bedrijf->achternaam->achternaam);
        });
    }

}
