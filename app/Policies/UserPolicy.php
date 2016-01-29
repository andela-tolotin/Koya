<?php

namespace Koya\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Auth;
class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function update($user, $user2)
    {
        return $user->username === $user2->username;
    }

    public function canUpdateVideo($user, $video)
    {
        dd($user->id);
        return $user->id === $video->user_id;
    }

    public function view()
    {
        return $this->auth->check();
    }
}
