<?php

namespace Koya;

use Illuminate\Database\Eloquent\Model;

/**
 * Model for comments, abstracting database intreface
 * Class Comment.
 */
class Comment extends Model
{
    /**
     * @var array Values to be savable to database
     */
    protected $fillable = [
        'comment', 'user_id', 'video_id',
    ];

    /**
     * Creates relationship between comments and videos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function video()
    {
        return $this->belongsTo('Koya\Video');
    }

    /**
     * Creates relationship between users and comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Koya\User');
    }
}
