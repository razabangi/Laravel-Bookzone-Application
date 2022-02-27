<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Team;
use Faker\Generator as Faker;

$factory->define(Team::class, function (Faker $faker) {
    $fullname = $faker->name;
    return [
        'fullname' => $fullname,
        'designation' => $faker->jobTitle,
        'telephone' => $faker->phoneNumber,
        'mobile' => $faker->e164PhoneNumber,
        'email' => $faker->safeEmail,
        'facebook_id' => $faker->freeEmail,
        'twitter_id' => $faker->freeEmail,
        'pinterest_id' => $faker->freeEmail,
        'profile' => $faker->paragraph,
        'team_img' => 'No image found',
        'status' => $faker->randomElement(array('DEACTIVE','ACTIVE'))
    ];
});
