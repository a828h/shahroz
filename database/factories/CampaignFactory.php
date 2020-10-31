<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Campaign;
use Faker\Generator as Faker;
use Morilog\Jalali\CalendarUtils;

$factory->define(Campaign::class, function (Faker $faker) {
    $startAt = $faker->dateTimeBetween('-1 years', 'now', null);
    $endAt = $faker->dateTimeBetween($startAt, 'now', null);
    $startAt = CalendarUtils::strftime('Y/m/d H:i:s', strtotime($startAt->format('Y/m/d H:i:s')));
    $endAt = CalendarUtils::strftime('Y/m/d H:i:s', strtotime($endAt->format('Ym/d H:i:s')));
    $startAt = CalendarUtils::convertNumbers($startAt);
    $endAt = CalendarUtils::convertNumbers($endAt);
    return [
        'name' => $faker->name,
        'platform' => $faker->randomElement(['telegram', 'instagram_post', 'instagram_story']),
        'status' => $faker->randomElement(['draft', 'active', 'archive']),
        'impersion_cnt' => $faker->numberBetween(100, 5000),
        'reach_cnt' => $faker->numberBetween(100, 5000),
        'clicks_cnt' => $faker->numberBetween(100, 5000),
        'like_cnt' => $faker->numberBetween(100, 5000),
        'share_cnt' => $faker->numberBetween(100, 5000),
        'save_cnt' => $faker->numberBetween(100, 5000),
        'sticker_tap_cnt' => $faker->numberBetween(100, 5000),
        'comment_cnt' => $faker->numberBetween(100, 5000),
        'start_at' => $startAt,
        'end_at' => $endAt,
    ];
});
