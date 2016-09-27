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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'first-name'          => $faker->firstName,
        'last-name'           => $faker->lastName,
        'email'               => $faker->unique()->safeEmail,
        'phone-number'        => $faker->e164PhoneNumber,
        'image-path'          => $faker->word . '.jpg',
        'department'          => 'Journalism',
        'title'               => $faker->jobTitle,
        'office-number'       => $faker->buildingNumber,
        'office-hours'        => $faker->dayOfWeek . ' ' . $faker->time($format = 'H:i'),
        'research'            => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'password'            => $password ?: $password = bcrypt('secret'),
        'remember_token'      => str_random(10),
    ];
});
