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
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'unit_name' => $faker->name,
        'unit_width' => $faker->numberBetween($min = 10, $max = 1000),
        'unit_length' => $faker->numberBetween($min = 10, $max = 1000),
        'unit_total_size' => $faker->numberBetween($min = 10, $max = 1000),
        'unit_gross_floor_area' => $faker->numberBetween($min = 1, $max = 10),
        'unit_bedroom'  => $faker->numberBetween($min = 1, $max = 100),
        'unit_bathroom' => $faker->numberBetween($min = 1, $max = 100),
        'unit_livingroom'  => $faker->numberBetween($min = 1, $max = 100),
        'unit_floor'  => $faker->numberBetween($min = 1, $max = 100),
        'unit_storey'   => $faker->numberBetween($min = 1, $max = 100),
        'unit_car_parking'    => $faker->numberBetween($min = 1, $max = 100),
        'unit_motor_parking'  => $faker->numberBetween($min = 1, $max = 100),
        'unit_cost_estimates'  => $faker->numberBetween($min = 10, $max = 10000),
        'unit_usefull_life'  => $faker->numberBetween($min = 10, $max = 1000),
        'unit_effective_age'  => $faker->numberBetween($min = 10, $max = 1000),
        'unit_completion_year'  => $faker->numberBetween($min = 10, $max = 1000),
        'title_deed_type'=> $faker->name,
        'title_deed_no'  => $faker->numberBetween($min = 10, $max = 10000),
        'issued_year'   => $faker->numberBetween($min = 10, $max = 10000),
        'parcel_no' =>$faker->numberBetween($min = 10, $max = 10000),
        'total_size_by_title_deed' => $faker->numberBetween($min = 10, $max = 10000),

    ];
});
