<?php

namespace Koya\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use \Cloudinary as CloudUpload;
use \Cloudinary\Uploader as Uploader;

use Auth;
use Koya\Http\Requests;
use Koya\Http\Controllers\Controller;
use Koya\Libraries\Cloudinary;
use Koya\Repositories\UserRepository;
use Socialite;

class SocialAuthController extends Controller
{
    /**
     * SocialAuthController constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user, Guard $guard, Cloudinary $cloudinary)
    {
        $this->user = $user;
        $this->guard = $guard;
        $this->cloudinary = $cloudinary;
    }

    /**
     * Authorizes the authentication provider to proceed to app
     * @param $provider
     * @return mixed
     */
    public function authorizeProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Logins the user by creating a new user if the user is not registered
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login($provider)
    {
        try {
            $data = $this->prepareUserData(Socialite::driver($provider)->user(), $provider);
            $user = $this->user->findOrCreate($data);
            $this->guard->loginUsingId($user->id);
        } catch (Exception $ex) {
            abort(500, 'There is a problem from the server, please try in a minute, or contact server admin');
        }

        return redirect('/dashboard');
    }

    /**
     * Builds user data for saving in the database
     * @param Koya\User $user
     * @param $provider
     * @return array
     */
    private function prepareUserData($user, $provider)
    {
        //Github uses avatar while facebook and twitter uses avatar_original for storing user image
        $avatar_url = $provider == 'github' ? $user->avatar : $user->avatar_original;

        //Upload user image to cloudinary
        $cloudinary_data = Uploader::upload($avatar_url);

        //Build data
        $data = [
            'name'           => $user->name,
            'username' => str_replace(' ', '.', strtolower($user->name)).".".time(),
            'email'          => $user->email,
            'password'       => null,
            'provider'       => $provider,
            'provider_id'    => $user->id,
            'provider_token' => $user->token,
            'avatar'         => $cloudinary_data['url'],
            'cloudinary_id'         => $cloudinary_data['public_id']
        ];

        return $data;
    }
}
