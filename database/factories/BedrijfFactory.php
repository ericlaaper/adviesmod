<?php

$factory->define(App\Bedrijf::class, function (Faker\Generator $faker) {
    return [
        "bedrijfsnaam" => $faker->name,
        "achternaam_id" => factory('App\Relatiemanager')->create(),
    ];
});
