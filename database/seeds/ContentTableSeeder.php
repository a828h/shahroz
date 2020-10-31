<?php

use App\Campaign;
use App\Media;
use App\Publisher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class MediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $campaigns = Campaign::all()->pluck('id')->toArray();
        for ($i = 0; $i < 500; $i++) {
            try {
                DB::table('medias')->insert([
                    'campaign_id' => $campaigns[array_rand($campaigns)],
                    'impersion_cnt' => $faker->numberBetween(100, 1500),
                    'reach_cnt' => $faker->numberBetween(100, 1500),
                    'clicks_cnt' => $faker->numberBetween(100, 1500),
                    'like_cnt' => $faker->numberBetween(100, 1500),
                    'share_cnt' => $faker->numberBetween(100, 1500),
                    'save_cnt' => $faker->numberBetween(100, 1500),
                    'sticker_tap_cnt' => $faker->numberBetween(100, 1500),
                    'comment_cnt' => $faker->numberBetween(100, 1500),
                ]);
                $publishers = Publisher::all()->pluck('id')->toArray();
                $medias = Media::all()->pluck('id')->toArray();
                DB::table('media_publisher')->insert([
                    'media_id' => $medias[array_rand($medias)],
                    'publisher_id' => $publishers[array_rand($publishers)],
                ]);
            } catch (Exception $e) {
                dd($e);
            }
        }
    }
}
