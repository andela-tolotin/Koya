<?php

namespace Koya;

use Illuminate\Database\Eloquent\Model;

/**
 * Class for favourite videos Model
 * Class FavouriteVideo.
 */
class FavouriteVideo extends Model
{
    /**
     * @var array Values to be savable to the database
     */
    protected $fillable = ['user_id', 'video_id'];

    /**
     * Creates a relationship between favourite video and user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne]
     */
    public function user()
    {
        return $this->hasOne('Koya\User');
    }

    /**
     * Creates relationship between favourite video and video model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function video()
    {
        return $this->hasOne('Koya\Video');
    }
}
