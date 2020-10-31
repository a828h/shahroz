<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(PublisherSeeder::class);
        $this->call(CampaignSeeder::class);
        $this->call(CampaignUserTableSeeder::class);
        $this->call(CampaignUserTableSeeder::class);
        // $this->call(CampaignPublisherTableSeeder::class);
    }
}
