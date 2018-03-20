<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(RelatiemanagerSeed::class);
        $this->call(BedrijfSeed::class);
        $this->call(KlantenSeed::class);
        $this->call(RoleSeed::class);
        $this->call(UserSeed::class);

    }
}
