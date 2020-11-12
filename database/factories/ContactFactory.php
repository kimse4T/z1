<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {

    return [
        'first_name' => $faker->firstName,
        'last_name'  => $faker->lastName,
        'salutation' => 'mr.',
        'type'       => 'owner',
        'phone'      => '123456789',
        //'created_at' => $faker->date('Y-m-d H:i:s'),
        //'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
