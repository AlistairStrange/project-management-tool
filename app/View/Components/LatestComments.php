<?php

namespace App\View\Components;

use App\Comment;
use Illuminate\View\Component;

class LatestComments extends Component
{
    public $comments;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Get 5 latest Comments
        $this->comments = Comment::orderBy('created_at', 'desc')->take(5)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.latest-comments');
    }
}
