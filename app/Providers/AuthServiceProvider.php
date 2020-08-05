<?php

namespace App\Providers;

use App\Todo;
use App\Ticket;
use App\ProjectBoard;
use App\Policies\TodoPolicy;
use App\Policies\TicketPolicy;
use App\Policies\ProjectBoardPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        ProjectBoard::class => ProjectBoardPolicy::class,
        Todo::class => TodoPolicy::class,
        Ticket::class => TicketPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
