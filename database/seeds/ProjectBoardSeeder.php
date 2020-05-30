<?php

use App\ProjectBoard;
use Illuminate\Database\Seeder;

class ProjectBoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ProjectBoard::class, 4)->create();
    }
}
