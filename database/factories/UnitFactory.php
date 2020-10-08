<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Unit;
use Faker\Generator as Faker;

$factory->define(Unit::class, function (Faker $faker) {

    return [
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
    ];
});
