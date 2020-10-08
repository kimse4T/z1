<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PropertyTitleDeed;
use Faker\Generator as Faker;

$factory->define(PropertyTitleDeed::class, function (Faker $faker) {

    return [
        'title_deed_type'=> $faker->name,
        'title_deed_no'  => $faker->numberBetween($min = 10, $max = 10000),
        'issued_year'   => $faker->numberBetween($min = 10, $max = 10000),
        'parcel_no' =>$faker->numberBetween($min = 10, $max = 10000),
        'total_size_by_title_deed' => $faker->numberBetween($min = 10, $max = 10000),
    ];
});
