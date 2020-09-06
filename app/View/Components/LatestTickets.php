<?php

namespace App\View\Components;

use App\Ticket;
use Illuminate\View\Component;

class LatestTickets extends Component
{
    public $tickets;

    /**
     * Create a new component instance.
     *
     * @return void
    */
    public function __construct()
    {
        // Get 5 latest tickets according to created_at 
        $this->tickets = Ticket::orderBy('created_at', 'desc')->take(5)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.latest-tickets');
    }
}
