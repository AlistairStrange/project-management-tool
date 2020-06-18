<?php

use App\User;
use App\ProjectBoard;
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
