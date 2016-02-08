<?php

namespace Koya\Providers;

use Auth;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Koya\Policies\UserPolicy;
use Koya\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Koya\Model' => 'Koya\Policies\ModelPolicy',
        User::class  => UserPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param \Illuminate\Contracts\Auth\Access\Gate $gate
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('canUpdateOrDeleteVideo', function ($user, $post) {
            return $user->id === $post->user_id;
        });

        $gate->define('comment', function () {
            return Auth::check();
        });

        $gate->define('createCategory', function () {
            return Auth::check();
        });
    }
}
