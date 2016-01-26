<?php

namespace Koya\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use Auth;
use Koya\Http\Requests;
use Koya\Http\Controllers\Controller;
use Koya\Repositories\UserRepository;
use Socialite;

class SocialAuthController extends Controller
{
    /**
     * SocialAuthController constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user, Guard $guard)
    {
        $this->user = $user;
        $this->guard = $guard;
    }

    /**
     * Authorizes the authenticationz provider to proceed to app
     * @param $provider
     * @return mixed
     */
    public function authorizeProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function login($provider)
    {
        try {
            $data = $this->prepareUserData(Socialite::driver($provider)->user(), $provider);
            $user = $this->user->findOrCreate($data);
            $this->guard->loginUsingId($user->id);
        } catch (Exception $ex) {
            abort(500, 'There is a problem from the server, please try in a minute, or contact server admin');
        }

        return redirect('/');
    }

    private function prepareUserData($user, $provider)
    {
        $data = [
            'name'           => $user->name,
            'username' => str_replace(' ', '.', strtolower($user->name)).".".time(),
            'email'          => $user->email,
            'password'       => null,
            'provider'       => $provider,
            'provider_id'    => $user->id,
            'provider_token' => $user->token,
            'avatar'         => $provider == 'github' ? $user->avatar : $user->avatar_original,
        ];
        return $data;
    }
}
