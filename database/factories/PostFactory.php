<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'subject' => $faker->sentence(5),
        'body' => $faker->paragraph()
    ];
});