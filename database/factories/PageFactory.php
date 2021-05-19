<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Page;
use Faker\Generator as Faker;

$factory->define(Page::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'title' => $faker->sentence(5, true),
        'slug' => $faker->slug,
        'body' => $faker->paragraph(5, true),
        'publish' => true
    ];
});
