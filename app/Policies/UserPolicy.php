<?php

namespace Koya\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

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
    }

    public function update($user, $user2)
    {
        return $user->username === $user2->username;
    }
}
