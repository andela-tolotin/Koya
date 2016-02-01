<?php

namespace Koya;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'title', 'user_id', 'youtubeID', 'description', 'cloudinary_id', 'category_id'
    ];

    public function user()
    {
        return $this->belongsTo("Koya\User");
    }
    public function category()
    {
        return $this->hasOne("Koya\Category");
    }

    public function comments()
    {
        return $this->hasMany("Koya\Comment")->orderBy('created_at', 'desc');
    }
}
