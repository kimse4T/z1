<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Unit;
use Faker\Generator as Faker;

$factory->state(Unit::class,'single', function (Faker $faker) {

    return [
        // 'name' => $faker->name,
        // 'width' => $faker->numberBetween($min = 10, $max = 1000),
        // 'length' => $faker->numberBetween($min = 10, $max = 1000),
        // 'total_size' => $faker->numberBetween($min = 10, $max = 1000),
        // 'gross_floor_area' => $faker->numberBetween($min = 1, $max = 10),
        // 'bedroom'  => $faker->numberBetween($min = 1, $max = 100),
        // 'bathroom' => $faker->numberBetween($min = 1, $max = 100),
        // 'livingroom'  => $faker->numberBetween($min = 1, $max = 100),
        // 'floor'  => $faker->numberBetween($min = 1, $max = 100),
        // 'storey'   => $faker->numberBetween($min = 1, $max = 100),
        // 'car_parking'    => $faker->numberBetween($min = 1, $max = 100),
        // 'motor_parking'  => $faker->numberBetween($min = 1, $max = 100),
        // 'cost_estimates'  => $faker->numberBetween($min = 10, $max = 10000),
        // 'usefull_life'  => $faker->numberBetween($min = 10, $max = 1000),
        // 'effective_age'  => $faker->numberBetween($min = 10, $max = 1000),
        // 'completion_year'  => $faker->numberBetween($min = 10, $max = 1000),
    ];
});
