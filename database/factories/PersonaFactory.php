<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Persona;
use Faker\Generator as Faker;

$factory->define(Persona::class, function (Faker $faker) {
    return [
        'nombre'=>$faker->name,
        'apellido'=>$faker->lastname,
        'edad'=>rand(1,90),
        'sexo'=>$faker->randomElement(['M','F']),
    ];
});
