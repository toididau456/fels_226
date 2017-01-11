<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name . ' ' . $faker->randomDigit(1, 200),
        'description' => $faker->realText($faker->numberBetween(16, 20)),
    ];
});

$factory->define(App\Models\Lesson::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->randomDigit(1, 5),
    ];
});

$factory->define(App\Models\Word::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->word . ' ' .  $faker->randomDigit(1, 1000),
    ];
});


$factory->define(App\Models\WordChoice::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->word . ' ' . $faker->randomDigit(1, 1000),
        'word_id' => $faker->randomDigit(1, 10),
        'correct' => 0,
    ];
});
