<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Publisher;
use Faker\Generator as Faker;

$factory->define(Publisher::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'platform' => $faker->randomElement(['telegram', 'instagram']),
        'status' => $faker->randomElement(['new', 'active', 'inactive']),
        'link' => $faker->url,
        'data' => [
            'follower' => $faker->numberBetween(100, 100000),
            'following' => $faker->numberBetween(100, 100000),
            'member' => $faker->numberBetween(100, 100000),
        ]
    ];
});
