<?php

namespace App\Providers;

use App\Todo;
use App\User;
use App\Ticket;
use App\Comment;
use App\ProjectBoard;
use App\Policies\TodoPolicy;
use App\Policies\UserPolicy;
use App\Policies\TicketPolicy;
use App\Policies\CommentPolicy;
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
        TodoItem::class => TodoItemPolicy::class,
        Ticket::class => TicketPolicy::class,
        Comment::class => CommentPolicy::class,
        User::class => UserPolicy::class,
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
