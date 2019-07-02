<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\Movie;
use App\Models\Character;

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

$factory->define(Movie::class, function (Faker $faker) {
    return [
        'id_api' => $faker->unique()->uuid,
        'title' => $faker->name,
        'description' => $faker->text,
        'director' => $faker->name,
        'producer' => $faker->name,
        'release_year' => $faker->year,
        'score' => $faker->numberBetween(75, 100),
        'created_at' => date('Y-m-d H:i:s')
    ];
});

$factory->define(Character::class, function (Faker $faker) {
    return [
        'id_api' => $faker->unique()->uuid,
        'name' => $faker->name,
        'gender' => $faker->randomElement(['Male','Female','', 'N/A']),
        'age' => $faker->numberBetween(0, 100),
        'eye_color' => $faker->randomElement(['Brown','Blue','Green', 'Yellow']),
        'hair_color' => $faker->randomElement(['Brown','Blue','Green', 'Yellow']),
        'movie_id_api' => $faker->randomElement(Movie::all()->pluck('id_api')),
        'created_at' => date('Y-m-d H:i:s')
    ];
});
