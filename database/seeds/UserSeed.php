<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Admin', 'email' => 'admin@admin.com', 'password' => '$2y$10$TD3vaCacwl85ZOaeQS3RSezdqnTKCLZsG2GKICayIcAzhyBevjWwm', 'role_id' => 1, 'remember_token' => '',],
            ['id' => 2, 'name' => 'Eric Laaper', 'email' => 'eric.laaper@continuitas.nl', 'password' => '$2y$10$cI1SVjMPRzt5VrlfelmpeelJ4wGVR1IAnNQmvHluE3zFOYlBuAMC.', 'role_id' => 1, 'remember_token' => null,],
            ['id' => 3, 'name' => 'Arie Heerschap', 'email' => 'a.heerschap@continuitas.nl', 'password' => '$2y$10$jn.uH2CfGkWi1u4xW1Efw.rXx8DseXFV9Xq6TCZKtsVQJhXV4mkz2', 'role_id' => 1, 'remember_token' => null,],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
