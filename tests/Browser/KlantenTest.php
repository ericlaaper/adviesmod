<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class KlantenTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateKlanten()
    {
        $admin = factory('App\User', 'admin')->create();
        $klanten = factory('App\Klanten')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $klanten) {
            $browser->loginAs($admin)
                ->visit(route('admin.klantens.index'))
                ->clickLink('Add new')
                ->type("voornaam", $klanten->voornaam)
                ->type("achternaam", $klanten->achternaam)
                ->type("email", $klanten->email)
                ->type("password", $klanten->password)
                ->select("naam_id", $klanten->naam_id)
                ->radio("geslacht", $klanten->geslacht)
                ->press('Save')
                ->assertRouteIs('admin.klantens.index')
                ->assertSeeIn("tr:last-child td[field-key='voornaam']", $klanten->voornaam)
                ->assertSeeIn("tr:last-child td[field-key='achternaam']", $klanten->achternaam)
                ->assertSeeIn("tr:last-child td[field-key='email']", $klanten->email)
                ->assertSeeIn("tr:last-child td[field-key='password']", $klanten->password)
                ->assertSeeIn("tr:last-child td[field-key='naam']", $klanten->naam->bedrijfsnaam)
                ->assertSeeIn("tr:last-child td[field-key='geslacht']", $klanten->geslacht);
        });
    }

    public function testEditKlanten()
    {
        $admin = factory('App\User', 'admin')->create();
        $klanten = factory('App\Klanten')->create();
        $klanten2 = factory('App\Klanten')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $klanten, $klanten2) {
            $browser->loginAs($admin)
                ->visit(route('admin.klantens.index'))
                ->click('tr[data-entry-id="' . $klanten->id . '"] .btn-info')
                ->type("voornaam", $klanten2->voornaam)
                ->type("achternaam", $klanten2->achternaam)
                ->type("email", $klanten2->email)
                ->type("password", $klanten2->password)
                ->select("naam_id", $klanten2->naam_id)
                ->radio("geslacht", $klanten2->geslacht)
                ->press('Update')
                ->assertRouteIs('admin.klantens.index')
                ->assertSeeIn("tr:last-child td[field-key='voornaam']", $klanten2->voornaam)
                ->assertSeeIn("tr:last-child td[field-key='achternaam']", $klanten2->achternaam)
                ->assertSeeIn("tr:last-child td[field-key='email']", $klanten2->email)
                ->assertSeeIn("tr:last-child td[field-key='password']", $klanten2->password)
                ->assertSeeIn("tr:last-child td[field-key='naam']", $klanten2->naam->bedrijfsnaam)
                ->assertSeeIn("tr:last-child td[field-key='geslacht']", $klanten2->geslacht);
        });
    }

    public function testShowKlanten()
    {
        $admin = factory('App\User', 'admin')->create();
        $klanten = factory('App\Klanten')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $klanten) {
            $browser->loginAs($admin)
                ->visit(route('admin.klantens.index'))
                ->click('tr[data-entry-id="' . $klanten->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='voornaam']", $klanten->voornaam)
                ->assertSeeIn("td[field-key='achternaam']", $klanten->achternaam)
                ->assertSeeIn("td[field-key='email']", $klanten->email)
                ->assertSeeIn("td[field-key='password']", $klanten->password)
                ->assertSeeIn("td[field-key='naam']", $klanten->naam->bedrijfsnaam)
                ->assertSeeIn("td[field-key='geslacht']", $klanten->geslacht);
        });
    }

}
