<?php

namespace App\Providers;

use App\ProjectBoard;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ProjectsOverviewProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
       
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //Passing Project Boards abbreviations & names to all views
        // which allows you to use it within app.blade.php (global nav)
        
        $projects = ProjectBoard::all()->pluck('name', 'abbreviation');
        View::share('projectList', $projects);
    }
}
