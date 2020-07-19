<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'password' => Hash::make('botBotBotBot'),
            'isAdmin' => 1,
            'role' => 'pm',
            'created_at' => now(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'name' => 'Alistair',
            'email' => "marek@jankovic.site",
            'password' => Hash::make('rastamanuf2hx'),
            'isAdmin' => 1,
            'role' => 'pm',
            'created_at' => now(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        factory(App\User::class, 5)->create();
    }
}
