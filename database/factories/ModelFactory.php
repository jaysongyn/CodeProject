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

$factory->define(CodeProject\Entities\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(CodeProject\Entities\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'responsable' => $faker->name,
        'email' => $faker->email,
        'phone' =>$faker->phoneNumber,
        'address' => $faker->address,
        'obs' => $faker->text(56)
    ];
});

$factory->define(CodeProject\Entities\Project::class, function (Faker\Generator $faker) {
    return [
        'owner_id' => $faker->numberBetween(1,10),
        'client_id' => $faker->numberBetween(1,10),
        'name' => $faker->name,
        'description' =>$faker->text(56),
        'progress' => $faker->numberBetween(0,100),
        'status' => $faker->numberBetween(1,3),
        'due_date' => $faker->dateTime()
    ];
});

$factory->define(CodeProject\Entities\ProjectNote::class, function (Faker\Generator $faker) {
    return [
        'project_id' => $faker->numberBetween(1,10),
        'title' => $faker->text(10),
        'note' => $faker->text(50)
    ];
});

$factory->define(CodeProject\Entities\ProjectTask::class, function (Faker\Generator $faker) {
    return [
        'project_id' => $faker->numberBetween(1,10),
        'name' => $faker->name,
        'status' => $faker->numberBetween(1,3),
        'start_date' => $faker->dateTime(),
        'due_date' => $faker->dateTime()
    ];
});

$factory->define(CodeProject\Entities\ProjectMember::class, function (Faker\Generator $faker) {
    return [
        'project_id' => $faker->numberBetween(1,10),
        'user_id' => $faker->numberBetween(1,10)
    ];
});