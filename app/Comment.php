<?php

namespace Koya;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment', 'user_id', 'video_id'
    ];

    public function video()
    {
        return $this->belongsTo('Koya\Video');
    }

    public function user()
    {
        return $this->belongsTo('Koya\User');
    }
}
