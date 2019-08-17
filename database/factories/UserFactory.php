<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Event;
use App\Question;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
$factory->define(Event::class, function (Faker $faker) {
    return [
        "event_name" => $faker->name,
        "event_description" => "Just a Test",
        "event_code" => Str::random(5),
        "event_link" => "http://localhost:8000/room?room=".Str::random(5),
        "user_id" => rand(1,2),
        "start_date" => now(),
        "end_date" => now(),
        "setting_join"=> 1,
        "setting_question"=> 1,
        "setting_reply"=> 1,
        "setting_moderation"=> 0,
        "setting_anonymous"=> 1,
    ];
});

$factory->define(Question::class, function (Faker $faker) {
    return [
        "event_id" => 1,
        "content" => Str::random(10),
        "user_name" => '',
        "status" => 0,
        "like" => 0,
        "unlike" => 0,
    ];
});
