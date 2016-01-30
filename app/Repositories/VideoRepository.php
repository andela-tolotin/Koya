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
use DB;

class VideoRepository
{
    public function __construct(Video $video, VideoTag $videoTag)
    {
        $this->video = $video;
        $this->videoTag = $videoTag;
    }

    public function getAllVideos()
    {
//        return $this->video->all();
        return $this->video->with('user')->paginate(20);
    }

    public function videoExists($video_id)
    {
        return !!$this->getVideoById($video_id);
    }

    public function getVideoUrl($url)
    {
        $value = 'error';
        if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $id)) {
            $value = $id[1];
        } else if (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $id)) {
            $value = $id[1];
        } else if (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $url, $id)) {
            $value = $id[1];
        } else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $id)) {
            $value = $id[1];
        }
        else if (preg_match('/youtube\.com\/verify_age\?next_url=\/watch%3Fv%3D([^\&\?\/]+)/', $url, $id)) {
            $value = $id[1];
        }
        return $value;
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

    public function getVideoById($video_id)
    {
        return $this->video->where('id', $video_id)->with('tags')->get()->first();
    }

    public function getAllUserVideos($user_id)
    {
        return $this->video->with('tags')->where('user_id', $user_id)->paginate(30);
    }

    public function save(Array $video_data, $user_id)
    {
        DB::transaction(function() use($video_data, $user_id){
            $tags = $video_data['tags'];
            $video_data['user_id'] = $user_id;
            $video = $this->video->create($video_data);
            return $video->tags()->sync(array_values($tags));
        });
        return false;
    }

    public function update(Array $video_data, $video_id)
    {
        DB::beginTransaction();
        try{
            $tags = $video_data['tags'];

            $video = $this->video->find($video_id);
            if($video->update($video_data)) {
                $video->tags()->sync(array_values($tags));
            }

        } catch(\Exception $ex) {
            DB::rollback();
            return false;
        }
        DB::commit();
        return true;
    }

    public function deleteVideo($video_id)
    {
        return $this->video->destroy($video_id);
    }


    public function generateTagsArray($tags)
    {
        $result = [];

        foreach($tags as $tag) {
            $result[$tag->id] = $tag->label;
        }

        return $result;
    }

    public function getVideoComments($video_id)
    {
        return $this->video
            ->with('comments.user')
            ->where('id', $video_id)
            ->get()
            ->first();
    }
}