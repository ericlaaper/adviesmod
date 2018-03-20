<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class RoleTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateRole()
    {
        $admin = factory('App\User', 'admin')->create();
        $role = factory('App\Role')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $role) {
            $browser->loginAs($admin)
                ->visit(route('admin.roles.index'))
                ->clickLink('Add new')
                ->type("title", $role->title)
                ->press('Save')
                ->assertRouteIs('admin.roles.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $role->title);
        });
    }

    public function testEditRole()
    {
        $admin = factory('App\User', 'admin')->create();
        $role = factory('App\Role')->create();
        $role2 = factory('App\Role')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $role, $role2) {
            $browser->loginAs($admin)
                ->visit(route('admin.roles.index'))
                ->click('tr[data-entry-id="' . $role->id . '"] .btn-info')
                ->type("title", $role2->title)
                ->press('Update')
                ->assertRouteIs('admin.roles.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $role2->title);
        });
    }

    public function testShowRole()
    {
        $admin = factory('App\User', 'admin')->create();
        $role = factory('App\Role')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $role) {
            $browser->loginAs($admin)
                ->visit(route('admin.roles.index'))
                ->click('tr[data-entry-id="' . $role->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $role->title);
        });
    }

}
