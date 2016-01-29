<?php

namespace Koya;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'title', 'user_id', 'youtubeID', 'description', 'cloudinary_id'
    ];

    public function user()
    {
        return $this->belongsTo("Koya\User");
    }
    public function tags()
    {
        return $this->belongsToMany("Koya\VideoTag", 'tags_pivot', 'video_id', 'video_tag_id');
    }

    public function comments()
    {
        return $this->hasMany("Koya\Comment")->orderBy('created_at', 'desc');
    }
}
