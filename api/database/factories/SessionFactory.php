<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Session;
use Faker\Generator as Faker;

$factory->define(Session::class, function (Faker $faker) {
    return [
        'name'                  => $faker->name,
        'platform_type'         => $faker->randomElement(['Telegram', 'WhatsApp', 'Facebook']),
        'contact_identifier'    => $faker->randomNumber(9, true),
    ];
});
