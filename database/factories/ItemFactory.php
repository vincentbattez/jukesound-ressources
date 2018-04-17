<?php

use Faker\Generator as Faker;

$factory->define(App\Item::class, function (Faker $faker) {
    $company = $faker->company;
    return [
        'id_category'      => App\Category::all(['id'])->random(),
        'name'             => $company,
        'slug'             => str_slug($company, '-'),
        'quantity'         => rand(0,150),
        'quantity_jukebox' => rand(1,20),
        'quantity_buy'     => rand(1,100),
        'url'              => $faker->url,
        'image'            => $faker->imageUrl,
    ];
});
