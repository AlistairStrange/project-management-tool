<?php
namespace Database\Seeders;

use App\User;
use App\ProjectBoard;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\CommentSeeder;
use Database\Seeders\TicketsSeeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\ProjectBoardSeeder;

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
        $this->call(CommentSeeder::class);

        // Add Users to specific project board 
        $projects = ProjectBoard::all();
        $users = User::all();

        foreach ($users as $user) {
            $user->projects()->attach($projects->random());
        }
    }
}
