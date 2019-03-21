<?php

use App\Especialidad;
use Faker\Generator as Faker;

$factory->define(Especialidad::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3,false)
    ];
});
