<?php

use Illuminate\Database\Seeder;

class KlantenSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'voornaam' => 'Piet', 'achternaam' => 'Baas', 'email' => 'p.baas@baas.nl', 'password' => 'Pleintje19', 'naam_id' => 1,],

        ];

        foreach ($items as $item) {
            \App\Klanten::create($item);
        }
    }
}
