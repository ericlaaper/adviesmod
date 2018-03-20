<?php

$factory->define(App\Relatiemanager::class, function (Faker\Generator $faker) {
    return [
        "voornaam" => $faker->name,
        "achternaam" => $faker->name,
        "email" => $faker->safeEmail,
        "geslacht" => collect(["heer","mevrouw",])->random(),
    ];
});
