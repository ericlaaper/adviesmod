<?php

use Illuminate\Database\Seeder;

class BedrijfSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'bedrijfsnaam' => 'Laapheer BV', 'achternaam_id' => 1,],

        ];

        foreach ($items as $item) {
            \App\Bedrijf::create($item);
        }
    }
}
