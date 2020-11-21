<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Publicacion;
use Faker\Generator as Faker;

$factory->define(Publicacion::class, function (Faker $faker) {
    return [
        'titulo'=>$faker->word(),
        'cuerpo'=>$faker->word(),
        'imagen'=> '',
        'user_id'=>$faker->numberbetween(1,10),
    ];
});
