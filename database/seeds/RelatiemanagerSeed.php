<?php

use Illuminate\Database\Seeder;

class RelatiemanagerSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'voornaam' => 'Eric', 'achternaam' => 'Laaper', 'email' => 'e.laaper@continuitas.nl', 'geslacht' => 'heer',],

        ];

        foreach ($items as $item) {
            \App\Relatiemanager::create($item);
        }
    }
}
