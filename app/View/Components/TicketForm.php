<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TicketForm extends Component
{
    public $ticket = "";

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($ticket = null)
    {
        $this->ticket = $ticket;
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
