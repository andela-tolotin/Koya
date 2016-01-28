<?php

namespace Koya\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class LoggedInUserPolicy
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
}
