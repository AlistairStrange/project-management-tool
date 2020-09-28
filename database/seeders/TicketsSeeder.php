<?php
namespace Database\Seeders;

use App\Ticket;
use Illuminate\Database\Seeder;

class TicketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Ticket::class, 30)->create();
        Ticket::factory()
            ->times(100)
            ->create();
    }
}
