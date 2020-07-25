<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Fmobj;
use Faker\Generator as Faker;

$factory->define(Fmobj::class, function (Faker $faker) {
    return [
        //
        'title' => $faker->word,
        'content' => $faker->realText
    ];
});
