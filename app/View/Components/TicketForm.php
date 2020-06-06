<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Http\Controllers\ProjectBoardController;

class TicketForm extends Component
{
    public $ticket = "";
    public $projects = "";

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($ticket = null, $projects = null)
    {
        $this->ticket = $ticket;
        $this->projects = $projects;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.ticket-form');
    }
}
