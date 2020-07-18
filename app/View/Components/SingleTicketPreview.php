<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SingleTicketPreview extends Component
{
    public $ticket;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($ticket)
    {
        $this->ticket = (object) $ticket;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.single-ticket-preview');
    }
}
