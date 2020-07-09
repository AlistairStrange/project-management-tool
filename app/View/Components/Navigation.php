<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class Navigation extends Component
{
    public $userProjectList = null;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Retrieving currently authenticated user
        $user = Auth::user();

        // If there's any authenticated user - returning list of assigned projects
        if(isset ($user)) {
            $this->userProjectList = $user->projects->pluck('name', 'abbreviation');
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.navigation');
    }
}
