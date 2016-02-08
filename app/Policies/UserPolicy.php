<?php

namespace Koya\Policies;

use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

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
        return $this->userSignedIn();
    }

    public function favourite()
    {
        return $this->userSignedIn();
    }

//    public function comment()
//    {
//        return Auth::check();
//    }
    private function userSignedIn()
    {
        return Auth::check();
    }
}
