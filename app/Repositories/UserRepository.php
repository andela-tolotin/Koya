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

    public function getAllUsers()
    {
        return $this->user->all();
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
    public function save($data)
    {
        try {
            $this->user->create($data);
        } catch (Exception $ex) {
            throw new \Exception('Error saving to database');
        }
    }
}
