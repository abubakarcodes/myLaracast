<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\models\Lesson;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\models\Series;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'username' => $faker->unique()->name,
        'email_verified_at' => now(),
        'password' => Hash::make('secret'), // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Series::class, function (Faker $faker) {
    $title = $faker->sentence();
    return [
        'title' => $title,
        'description' => $faker->paragraph(),
        'slug' => Str::slug($title),
        'imageUrl' => "image" . $faker->numberBetween(1,10) . ".jpg",
    ];
});

$factory->define(Lesson::class, function (Faker $faker) {
    return [
        'series_id' => $faker->numberBetween(1,100),
        'episode_number' => $faker->numberBetween(1,10),
        'video_id' => $faker->numberBetween(20000, 500000),
        'title' => $faker->sentence(),
        'description' => $faker->paragraph(),
    ];
});
