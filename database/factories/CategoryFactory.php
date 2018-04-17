<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    $company = $faker->company;
    return [
        'name'             => $company,
        'slug'             => str_slug($company, '-'),
    ];
});
