<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'aaaa',
            'last_name' => 'bbbb',
            'mobile' => '09196689868',
            'brand' => 'kkkkk',
            'role' => 'super_admin',
            'status' => 'active',
            'email' => 'a.h.heydari8@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => '',
        ]);
        factory(App\User::class, 50)->create();
    }
}
