<?php

/** @var Factory $factory */

use App\Products;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Products::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'desc' => $faker->sentence,
        'color' => $faker->randomElement(['red' ,'blue', 'green']),
        'amount' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 10000),
        'available' => $faker->randomDigit(),
        'created_by' => rand(1, \App\User::count()),
        'updated_by' => rand(1, \App\User::count()),
    ];
});
