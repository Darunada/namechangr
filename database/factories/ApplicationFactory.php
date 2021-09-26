<?php

use App\Models\Location\State;
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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Application\Application::class, function (Faker $faker) {
    return [
        'user_id' => fn() => factory(App\User::class)->create()->id,
        'state_id' => fn() => State::where('name', 'Utah')->first()->id,
        'name_change' => true,
        'gender_change' => true,
        'data' => [],
        'is_generating_documents' => false
    ];
});
