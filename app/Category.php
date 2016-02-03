<?php

namespace Koya;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['label', 'cloudinary_id'];
    public function videos()
    {
        return $this->hasMany('Koya\Video');
    }
}
