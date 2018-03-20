<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class RelatiemanagerTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateRelatiemanager()
    {
        $admin = factory('App\User', 'admin')->create();
        $relatiemanager = factory('App\Relatiemanager')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $relatiemanager) {
            $browser->loginAs($admin)
                ->visit(route('admin.relatiemanagers.index'))
                ->clickLink('Add new')
                ->type("voornaam", $relatiemanager->voornaam)
                ->type("achternaam", $relatiemanager->achternaam)
                ->type("email", $relatiemanager->email)
                ->radio("geslacht", $relatiemanager->geslacht)
                ->press('Save')
                ->assertRouteIs('admin.relatiemanagers.index')
                ->assertSeeIn("tr:last-child td[field-key='voornaam']", $relatiemanager->voornaam)
                ->assertSeeIn("tr:last-child td[field-key='achternaam']", $relatiemanager->achternaam)
                ->assertSeeIn("tr:last-child td[field-key='email']", $relatiemanager->email)
                ->assertSeeIn("tr:last-child td[field-key='geslacht']", $relatiemanager->geslacht);
        });
    }

    public function testEditRelatiemanager()
    {
        $admin = factory('App\User', 'admin')->create();
        $relatiemanager = factory('App\Relatiemanager')->create();
        $relatiemanager2 = factory('App\Relatiemanager')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $relatiemanager, $relatiemanager2) {
            $browser->loginAs($admin)
                ->visit(route('admin.relatiemanagers.index'))
                ->click('tr[data-entry-id="' . $relatiemanager->id . '"] .btn-info')
                ->type("voornaam", $relatiemanager2->voornaam)
                ->type("achternaam", $relatiemanager2->achternaam)
                ->type("email", $relatiemanager2->email)
                ->radio("geslacht", $relatiemanager2->geslacht)
                ->press('Update')
                ->assertRouteIs('admin.relatiemanagers.index')
                ->assertSeeIn("tr:last-child td[field-key='voornaam']", $relatiemanager2->voornaam)
                ->assertSeeIn("tr:last-child td[field-key='achternaam']", $relatiemanager2->achternaam)
                ->assertSeeIn("tr:last-child td[field-key='email']", $relatiemanager2->email)
                ->assertSeeIn("tr:last-child td[field-key='geslacht']", $relatiemanager2->geslacht);
        });
    }

    public function testShowRelatiemanager()
    {
        $admin = factory('App\User', 'admin')->create();
        $relatiemanager = factory('App\Relatiemanager')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $relatiemanager) {
            $browser->loginAs($admin)
                ->visit(route('admin.relatiemanagers.index'))
                ->click('tr[data-entry-id="' . $relatiemanager->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='voornaam']", $relatiemanager->voornaam)
                ->assertSeeIn("td[field-key='achternaam']", $relatiemanager->achternaam)
                ->assertSeeIn("td[field-key='email']", $relatiemanager->email)
                ->assertSeeIn("td[field-key='geslacht']", $relatiemanager->geslacht);
        });
    }

}
