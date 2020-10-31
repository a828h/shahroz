<?php

use App\Campaign;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampaignUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all()->pluck('id')->toArray();
        $campaigns = Campaign::all()->pluck('id')->toArray();
        for ($i = 0; $i < 200; $i++) {
            try {
                DB::table('campaign_user')->insert([
                    'campaign_id' => $campaigns[array_rand($campaigns)],
                    'user_id' => $users[array_rand($users)]
                ]);
            } catch (Exception $e) {
                dd($e);
            }
        }
    }
}
