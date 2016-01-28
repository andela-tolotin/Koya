<?php

namespace Koya;

use Illuminate\Database\Eloquent\Model;

class VideoTag extends Model
{
    protected $fillable = ['label'];
    public function videos()
    {
        return $this->belongsToMany('Koya\Video', 'tags_pivot', 'video_tag_id', 'video_id');
    }

}
