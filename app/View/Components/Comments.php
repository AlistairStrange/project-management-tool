<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Comments extends Component
{
    public $ticket;
    public $comments;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($ticket, $comments = null)
    {
        $this->ticket = $ticket;
        $this->comments = $ticket->comments->all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.comments');
    }
}
