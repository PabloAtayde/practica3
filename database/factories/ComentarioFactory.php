<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comentario;
use Faker\Generator as Faker;

$factory->define(Comentario::class, function (Faker $faker) {
    return [
        'cuerpo'=>$faker->word(),
        'publicacion_id'=>$faker->numberbetween(1,50),
        'user_id'=>$faker->numberbetween(1,10),
    ];
});
