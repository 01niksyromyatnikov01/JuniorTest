<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Http\Controllers\Auth;

class UserPolicy
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

    public function subscribe()
    {
        return isset(\Auth::user()->id);

    }

    public function unsubscribe()
    {
        return isset(\Auth::user()->id);

    }

    public function checkIfSub()
    {
        return isset(\Auth::user()->id);
    }


}
