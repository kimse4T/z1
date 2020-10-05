<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Account;
use Faker\Generator as Faker;

$factory->define(Account::class, function (Faker $faker) {

    return [
        'account_number' => $faker->numberBetween(0,9999999),
        'bank_branch' => $faker->name,
        'billing_address' =>$faker->name,
        'valid_until'   =>$faker->date('Y-m-d H:i:s'),
        'name'  => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->numberBetween(0,1234567),
        'industry' => $faker->name,
        'website'  => $faker->email,
        'description' => $faker->sentence,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
