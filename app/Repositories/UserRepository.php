<?php

namespace Koya\Repositories;

use Log;
use Koya\User;
use Mockery\CountValidator\Exception;

/**
 * Class UserRepository
 * @package Koya\Repositories
 */
class UserRepository
{

    /**
     * Loads all dependencies for class
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Checks to see if user exists
     * @param $user_id
     * @return bool
     */
    public function userExists($user_id)
    {
        return !!$this->getUserByID($user_id);
    }

    /**
     * Returns all registered users
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllUsers()
    {
        return $this->user->all();
    }

    /**
     * Gets a registered user by id
     * @param $user_id
     * @return mixed
     */
    public function getUserByID($user_id)
    {
        return $this->user->find($user_id);
    }

    /**
     * Gets a registered user by username
     * @param $username
     * @return mixed
     */
    public function getUserByUsername($username)
    {
        return $this->user->where('username', $username)->get()->first();
    }

    /**
     * Gets a user by auth provider_id
     * @param $provider_id
     * @return mixed
     */
    public function getByProviderId($provider_id)
    {
        return $this->user->where('provider_id', $provider_id)->get()->first();
    }

    /**
     * Finds a user or creates a new user of not found
     * @param $providerUser
     * @return mixed|static
     */
    public function findOrCreate($providerUser)
    {
        $user  = $this->getByProviderId($providerUser["provider_id"]);
        if($user == null){
            $user = $this->user->create($providerUser);
        }
        return $user;
    }

    /**
     * Creates a new user
     * @param $data
     */
    public function create($data)
    {
        try {
            $this->user->create($data);
        } catch (Exception $ex) {
           abort(500);
        }
    }

    /**
     * Updates a user
     * @param array $data
     * @param String $username
     * @return bool
     */
    public function update(Array $data, $username)
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
