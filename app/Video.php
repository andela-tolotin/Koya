<?php

namespace Koya;

use Illuminate\Database\Eloquent\Model;

/**
 * Video model for accessing videos
 * Class Video.
 */
class Video extends Model
{
    /**
     * Mass assignable properties.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'user_id', 'youtubeID', 'description', 'cloudinary_id', 'category_id',
    ];

    /**
     * Creates a relationship between user and videos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo("Koya\User");
    }

    /**
     * Creates a relationship between video and category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne("Koya\Category");
    }

    /**
     * Creates a relationship between videos and comments.
     *
     * @return mixed
     */
    public function comments()
    {
        return $this->hasMany("Koya\Comment")->orderBy('created_at', 'desc');
    }

    /**
     * Creates a relationship between video and favourites.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favourites()
    {
        return $this->hasMany('Koya\FavouriteVideo');
    }
}
