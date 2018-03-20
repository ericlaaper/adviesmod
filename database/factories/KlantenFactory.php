<?php

$factory->define(App\Klanten::class, function (Faker\Generator $faker) {
    return [
        "voornaam" => $faker->name,
        "achternaam" => $faker->name,
        "email" => $faker->safeEmail,
        "password" => $faker->name,
        "naam_id" => factory('App\Bedrijf')->create(),
        "geslacht" => collect(["heer","mevrouw",])->random(),
    ];
});
