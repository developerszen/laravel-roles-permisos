<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    function create(User $user) {
        if($user->can('register user')) {
            return true;
        }
    }

    function edit(User $user) {
        if($user->can('edit all user')) {
            return true;
        }
    }
}
