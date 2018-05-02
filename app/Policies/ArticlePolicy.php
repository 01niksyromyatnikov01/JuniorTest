<?php

namespace App\Policies;

use App\User;
use App\Article;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Http\Controllers\Auth;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user,Article $article)
    {
        return $user->id === $article->user_id;

        // Удаление задачи...
    }
    public function create()
    {
        return isset(\Auth::user()->id);

        // Удаление задачи...
    }

    public function update(User $user, Article $article)
    {
        return $user->id === $article->user_id;

        // Удаление задачи...
    }
}
