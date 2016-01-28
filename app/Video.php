<?php

namespace Koya;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'title', 'user_id', 'link', 'description', 'cloudinary_id'
    ];

    public function user()
    {
        return $this->belongsTo("Koya\User");
    }
    public function tags()
    {
        return $this->belongsToMany("Koya\VideoTag", 'tags_pivot', 'video_id', 'video_tag_id');
    }
}
