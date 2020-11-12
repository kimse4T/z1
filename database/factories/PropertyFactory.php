<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Property;
use Faker\Generator as Faker;

$factory->define(Property::class, function (Faker $faker) {

    return [
        'address'   => $faker->address,
        'land_width'=> $faker->numberBetween($min = 10, $max = 1000),
        'land_length'=> $faker->numberBetween($min = 10, $max = 1000),
        'land_area'=> $faker->numberBetween($min = 10, $max = 1000),
        'sale_price_asking'  =>$faker->numberBetween($min = 10, $max = 1000),
        'sale_asking_price_per_sqm'   =>$faker->numberBetween($min = 10, $max = 1000),
        'sale_price'  =>$faker->numberBetween($min = 10, $max = 1000),
        'sale_price_per_sqm'  =>$faker->numberBetween($min = 10, $max = 1000),
        'sale_list_price'  =>$faker->numberBetween($min = 10, $max = 1000),
        'sale_list_price_per_sqm'   =>$faker->numberBetween($min = 10, $max = 1000),
        'sold_price'  =>$faker->numberBetween($min = 10, $max = 1000),
        'sold_price_per_sqm'  =>$faker->numberBetween($min = 10, $max = 1000),
        'sale_commission'  =>$faker->numberBetween($min = 10, $max = 1000),
        'rent_price_asking'  =>$faker->numberBetween($min = 10, $max = 1000),
        'rent_asking_price_per_sqm'  =>$faker->numberBetween($min = 10, $max = 1000),
        'rent_price'  =>$faker->numberBetween($min = 10, $max = 1000),
        'rent_price_per_sqm'  =>$faker->numberBetween($min = 10, $max = 1000),
        'rent_list_price'  =>$faker->numberBetween($min = 10, $max = 1000),
        'rent_list_price_per_sqm'  =>$faker->numberBetween($min = 10, $max = 1000),
        'rented_price'  =>$faker->numberBetween($min = 10, $max = 1000),
        'rented_price_per_sqm'  =>$faker->numberBetween($min = 10, $max = 1000),
        'rental_cmmission'  =>$faker->numberBetween($min = 10, $max = 1000),
        //'created_at' => $faker->date('Y-m-d H:i:s'),
        //'updated_at' => $faker->date('Y-m-d H:i:s'),



    ];
});


