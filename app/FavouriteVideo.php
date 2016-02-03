<?php

namespace Koya;

use Illuminate\Database\Eloquent\Model;

class FavouriteVideo extends Model
{
    protected $fillable = ['user_id', 'video_id'];

    public function user()
    {
        return $this->hasOne('Koya\User');
    }

    public function video()
    {
        return $this->hasOne('Koya\Video');
    }
}
