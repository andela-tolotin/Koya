<?php

namespace Koya;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Model for accessing users information
 * Class User
 * @package Koya
 */
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username' ,'email', 'password', 'provider', 'provider_id', 'provider_token', 'avatar', 'cloudinary_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Creates a relationship between User and videos
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videos()
    {
        return $this->hasMany('Koya\Video');
    }

    /**
     * reates a relationship between user and comments
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('Koya\Comments');
    }

    /**
     * Creates relationship between user and favourites
     * @return mixed
     */
    public function favourites()
    {
        return $this->hasManay('Koya\FavouriteVideo');
    }

}
