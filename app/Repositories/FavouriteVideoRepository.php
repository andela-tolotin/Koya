<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 03/02/2016
 * Time: 09:31.
 */
namespace Koya\Repositories;

use Koya\FavouriteVideo;
use Koya\User;
use Koya\Video;

/**
 * Class FavouriteVideoRepository.
 */
class FavouriteVideoRepository
{
    /**
     * Loads all dependencies for the class
     * FavouriteVideoRepository constructor.
     *
     * @param FavouriteVideo $favouriteVideo
     * @param Video          $video
     * @param User           $user
     */
    public function __construct(FavouriteVideo $favouriteVideo, Video $video, User $user)
    {
        $this->favouriteVideo = $favouriteVideo;
        $this->video = $video;
        $this->user = $user;
    }

    /**
     * Checks to see if user has liked videos.
     *
     * @param $video_id
     * @param $user_id
     *
     * @return bool
     */
    public function hasUserLikedVideo($video_id, $user_id)
    {
        return (bool) count(
            $this->favouriteVideo
            ->where('video_id', $video_id)
            ->where('user_id', $user_id)
            ->get()
        );
    }

    /**
     * Adds video to user's favourite.
     *
     * @param $video_id
     * @param $user_id
     *
     * @return static
     */
    public function likeVideo($video_id, $user_id)
    {
        return $this->favouriteVideo->create(['video_id' => $video_id, 'user_id' => $user_id]);
    }

    /**
     * Removes video from user's favourites.
     *
     * @param $video_id
     * @param $user_id
     *
     * @return mixed
     */
    public function unlikeVideo($video_id, $user_id)
    {
        return $this->favouriteVideo
            ->where('video_id', $video_id)
            ->where('user_id', $user_id)
            ->delete();
    }
}
