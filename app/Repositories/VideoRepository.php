<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 28/01/2016
 * Time: 12:35
 */

namespace Koya\Repositories;

use Koya\Category;
use Koya\User;
use Koya\Video;
use DB;

/**
 * Class VideoRepository
 * @package Koya\Repositories
 */
class VideoRepository
{
    /**
     * Loads classes via DI
     * VideoRepository constructor.
     * @param Video $video
     * @param Category $category
     */
    public function __construct(Video $video, Category $category)
    {
        $this->video = $video;
        $this->category = $category;
    }

    /**
     * Gets all uploaded videos
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllVideos()
    {
        return $this->video->with('user')->paginate(20);
    }

    /**
     * Checks to see if video exists
     * @param $video_id
     * @return bool
     */
    public function videoExists($video_id)
    {
        return !!$this->getVideoById($video_id);
    }

    /**
     * Extracts youtube ID from youtube URL
     * @param $url
     * @return string
     */
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

    /**
     * Gets videos in a category
     * @param $category_id
     * @return mixed
     */
    public function getVideosByCategory($category_id)
    {
        return $this->video->where('category_id', $category_id)->get();
    }

    /**
     * Gets video by given ID
     * @param $video_id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function getVideoById($video_id)
    {
        return $this->video
            ->with('favourites')
            ->with('user')
            ->findOrFail($video_id);
    }

    /**
     * Gets all video by a user with pagination
     * @param $user_id
     * @return mixed
     */
    public function getAllUserVideos($user_id)
    {
        return $this->video->where('user_id', $user_id)->paginate(20);
    }

    /**
     * Saves a new video
     * @param array $video_data
     * @return static
     */
    public function save(Array $video_data)
    {
        $video = $this->video->create($video_data);
        return $video;
    }

    /**
     * Updates an uploaded video
     * @param array $video_data
     * @param $video_id
     * @return bool
     */
    public function update(Array $video_data, $video_id)
    {
        DB::beginTransaction();
        try{
            $video = $this->video->find($video_id);
            $video->update($video_data);
        } catch(\Exception $ex) {
            DB::rollback();
            return false;
        }
        DB::commit();
        return true;
    }


    /**
     * Deletes an uploaded video
     * @param $video_id
     * @return int
     */
    public function deleteVideo($video_id)
    {
        return $this->video->destroy($video_id);
    }


    /**
     * Gets video with associated comments and user
     * @param $video_id
     * @return mixed
     */
    public function getVideoComments($video_id)
    {
        return $this->video
            ->with('comments.user')
            ->where('id', $video_id)
            ->paginate(20)
            ->first();
    }
}