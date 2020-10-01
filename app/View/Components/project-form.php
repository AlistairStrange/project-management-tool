<?php

namespace App\View\Components;

use Illuminate\View\Component;

class project-form extends Component
{
    
    public $project = "";

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($project = null)
    {
        $this->project = $project;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.project-form');
    }
}
