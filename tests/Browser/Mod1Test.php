<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class Mod1Test extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateMod1()
    {
        $admin = factory('App\User', 'admin')->create();
        $mod1 = factory('App\Mod1')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $mod1) {
            $browser->loginAs($admin)
                ->visit(route('admin.mod1s.index'))
                ->clickLink('Add new')
                ->type("mod1vr1", $mod1->mod1vr1)
                ->type("mod1opm1", $mod1->mod1opm1)
                ->type("mod1vr2", $mod1->mod1vr2)
                ->type("mod1opm2", $mod1->mod1opm2)
                ->press('Save')
                ->assertRouteIs('admin.mod1s.index')
                ->assertSeeIn("tr:last-child td[field-key='mod1vr1']", $mod1->mod1vr1)
                ->assertSeeIn("tr:last-child td[field-key='mod1opm1']", $mod1->mod1opm1)
                ->assertSeeIn("tr:last-child td[field-key='mod1vr2']", $mod1->mod1vr2)
                ->assertSeeIn("tr:last-child td[field-key='mod1opm2']", $mod1->mod1opm2);
        });
    }

    public function testEditMod1()
    {
        $admin = factory('App\User', 'admin')->create();
        $mod1 = factory('App\Mod1')->create();
        $mod12 = factory('App\Mod1')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $mod1, $mod12) {
            $browser->loginAs($admin)
                ->visit(route('admin.mod1s.index'))
                ->click('tr[data-entry-id="' . $mod1->id . '"] .btn-info')
                ->type("mod1vr1", $mod12->mod1vr1)
                ->type("mod1opm1", $mod12->mod1opm1)
                ->type("mod1vr2", $mod12->mod1vr2)
                ->type("mod1opm2", $mod12->mod1opm2)
                ->press('Update')
                ->assertRouteIs('admin.mod1s.index')
                ->assertSeeIn("tr:last-child td[field-key='mod1vr1']", $mod12->mod1vr1)
                ->assertSeeIn("tr:last-child td[field-key='mod1opm1']", $mod12->mod1opm1)
                ->assertSeeIn("tr:last-child td[field-key='mod1vr2']", $mod12->mod1vr2)
                ->assertSeeIn("tr:last-child td[field-key='mod1opm2']", $mod12->mod1opm2);
        });
    }

    public function testShowMod1()
    {
        $admin = factory('App\User', 'admin')->create();
        $mod1 = factory('App\Mod1')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $mod1) {
            $browser->loginAs($admin)
                ->visit(route('admin.mod1s.index'))
                ->click('tr[data-entry-id="' . $mod1->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='mod1vr1']", $mod1->mod1vr1)
                ->assertSeeIn("td[field-key='mod1opm1']", $mod1->mod1opm1)
                ->assertSeeIn("td[field-key='mod1vr2']", $mod1->mod1vr2)
                ->assertSeeIn("td[field-key='mod1opm2']", $mod1->mod1opm2)
                ->assertSeeIn("td[field-key='created_by']", $mod1->created_by->name);
        });
    }

}
