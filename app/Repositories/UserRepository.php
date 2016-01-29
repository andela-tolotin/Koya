<?php

namespace Koya\Repositories;

use Log;
use Koya\User;
use Mockery\CountValidator\Exception;

class UserRepository
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function userExists($user_id)
    {
        return !!$this->getUserByID($user_id);
    }

    public function getAllUsers()
    {
        return $this->user->all();
    }

    public function getUserByID($user_id)
    {
        return $this->user->find($user_id);
    }

    public function getUserByUsername($username)
    {
        return $this->user->where('username', $username)->get()->first();
    }

    public function getByProviderId($provider_id)
    {
        return $this->user->where('provider_id', $provider_id)->get()->first();
    }

    public function findOrCreate($providerUser)
    {
        $user  = $this->getByProviderId($providerUser["provider_id"]);
        if($user == null){
            $user = $this->user->create($providerUser);
        }
        return $user;
    }

    public function create($data)
    {
        try {
            $this->user->create($data);
        } catch (Exception $ex) {
           abort(500);
        }
    }

    public function update($data, $username)
    {
        try{
            $user = $this->getUserByUsername($username);
            $user->update($data);
        } catch(Exception $ex) {
            abort(500);
        }

        return true;
    }
}
