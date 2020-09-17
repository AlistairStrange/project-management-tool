<?php
namespace Database\Seeders;

use App\User;
use App\ProjectBoard;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\TicketsSeeder;
use Database\Seeders\ProjectBoardSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $this->call(ProjectBoardSeeder::class);
        $this->call(TicketsSeeder::class);

        // Add Users to specific project board 
        $projects = ProjectBoard::all();
        $users = User::all();

        foreach ($users as $user) {
            $user->projects()->attach($projects->random());
        }
    }
}
