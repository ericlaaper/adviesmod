<?php

use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'Beheerder (kan gebruikers toevoegen)',],
            ['id' => 2, 'title' => 'Gewone gebruiker',],
            ['id' => 3, 'title' => 'Leiding',],

        ];

        foreach ($items as $item) {
            \App\Role::create($item);
        }
    }
}
