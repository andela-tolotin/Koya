<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 28/01/2016
 * Time: 12:35
 */

namespace Koya\Repositories;

use Koya\User;
use Koya\Video;
use Koya\VideoTag;

class VideoRepository
{
    public function __construct(Video $video, VideoTag $videoTag)
    {
        $this->video = $video;
        $this->videoTag = $videoTag;
    }

    public function getAllVideos()
    {
        return $this->video->all();
    }

    public function getAllTags()
    {
        return $this->videoTag->all();
    }

    public function getTagByLabel($tag_label)
    {
        return $this->videoTag->where('label', $tag_label);
    }

    public function getAllVideosWithTags()
    {
        return $this->video->with('tags')->get();
    }

    public function getAllUserVideos($user_id)
    {
        return $this->video->with('tags')->where('user_id', $user_id)->get();
    }

    public function save(Array $video_data, $user_id)
    {
        $tags = $video_data['tags'];
        $video_data['user_id'] = $user_id;
        $video = $this->video->create($video_data);
        return $video->tags()->sync(array_values($tags));
    }
}