<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 03/02/2016
 * Time: 09:31
 */

namespace Koya\Repositories;


use Koya\FavouriteVideo;
use Koya\User;
use Koya\Video;

class FavouriteVideoRepository
{
    public function __construct(FavouriteVideo $favouriteVideo, Video $video, User $user)
    {
        $this->favouriteVideo = $favouriteVideo;
        $this->video = $video;
        $this->user = $user;
    }

    public function hasUserLikedVideo($video_id, $user_id)
    {
        return !!count(
            $this->favouriteVideo
            ->where('video_id', $video_id)
            ->where('user_id', $user_id)
            ->get()
        );
    }

    public function likeVideo($video_id, $user_id)
    {
        return $this->favouriteVideo->create(['video_id' => $video_id, 'user_id' => $user_id]);
    }

    public function unlikeVideo($video_id, $user_id)
    {
        return $this->favouriteVideo
            ->where('video_id', $video_id)
            ->where('user_id', $user_id)
            ->delete();
    }
}