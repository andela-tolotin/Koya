<?php

namespace Koya;

use Illuminate\Database\Eloquent\Model;

/**
 * Model for Category for making DB queries
 * Class Category.
 */
class Category extends Model
{
    /**
     * @var array values to be savable to database
     */
    protected $fillable = ['label', 'cloudinary_id'];

    /**
     * Creates relationship between videos and category it belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videos()
    {
        return $this->hasMany('Koya\Video');
    }
}
