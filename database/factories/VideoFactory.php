<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Model\Video;
use Faker\Generator as Faker;

$factory->define(Video::class, function (Faker $faker) {
    $rating = ["L", "10", "12", "14", "16", "18"];
    $values = [2022, 2021, 2020, 2019, 2018, 2017];
    $key = array_rand($values);
    $keyRating = array_rand($rating);
    return [
        "title" => $faker->colorName,
        "description" => $faker->colorName,
        "year_launched" => $values[$key],
        "opened" => true,
        "rating" => $rating[$keyRating],
        "duration" => 120
    ];
});
