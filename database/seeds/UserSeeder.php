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
            'name' => 'botUser',
            'email' => 'bot@user.com',
            'password' => 'botBotBotBot',
            'isAdmin' => 1,
            'role' => 'pm',
        ]);
    }
}
