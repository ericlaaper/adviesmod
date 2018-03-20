<?php

$factory->define(App\Mod1::class, function (Faker\Generator $faker) {
    return [
        "achternaam_id" => factory('App\Klanten')->create(),
        "mod1vr1" => $faker->randomNumber(2),
        "mod1opm1" => $faker->name,
        "mod1vr2" => $faker->randomNumber(2),
        "mod1opm2" => $faker->name,
        "created_by_id" => factory('App\User')->create(),
    ];
});
