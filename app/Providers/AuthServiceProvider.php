<?php

namespace App\Providers;

use App\Article;
use App\Comment;
use App\User;
use App\Policies\CommentPolicy;
use App\Policies\ArticlePolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Comment::class => CommentPolicy::class,
        Article::class => ArticlePolicy::class,
        User::class => UserPolicy::class,
    ];


    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */




    public function boot(GateContract $gate)
    {
        //parent::registerPolicies($gate);
        $this->registerPolicies();
        $this->registerPolicies($gate);
    }
}
