<?php

namespace Koya\Http\Controllers;

use Alaouy\Youtube\Facades\Youtube;
use Illuminate\Http\Request;
use Auth;
use Gate;
use Koya\Http\Requests;
use Koya\Http\Controllers\Controller;
use Koya\Http\Requests\VideosRequest;
use Koya\Libraries\Cloudinary;
use Koya\Repositories\CategoryRepository;
use Koya\Repositories\CommentRepository;
use Koya\Repositories\FavouriteVideoRepository;
use Koya\Repositories\VideoRepository;

class VideosController extends Controller
{
    /**
     * Loads all DI objects for the class
     * VideosController constructor.
     * @param VideoRepository $video
     * @param Cloudinary $cloudinary
     * @param CommentRepository $comment
     * @param CategoryRepository $categoryRepository
     * @param FavouriteVideoRepository $favouriteVideoRepository
     */
    public function __construct(
        VideoRepository $video,
        Cloudinary $cloudinary,
        CommentRepository $comment,
        CategoryRepository $categoryRepository,
        FavouriteVideoRepository $favouriteVideoRepository
    )
    {
        $this->video = $video;
        $this->comment = $comment;
        $this->cloudinary = $cloudinary;
        $this->category = $categoryRepository;
        $this->favourite  = $favouriteVideoRepository;
    }

    /**
     * Shows a single video  with comments
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        $video = $this->video->getVideoComments($request->video_id);
        return view('videos.show', compact('video'));
    }

    /**
     * Loads a view for editing video
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        //Get The user to be updated
        $video = $this->video->getVideoById($request->video_id);

        //Check to see if user is authorized to access this method
        $this->authorize('canUpdateOrDeleteVideo', $video);

        //Get all the category in the database
        $categories = $this->category->getAllCategories()->pluck('label');
        return view('videos.update', compact('video', 'categories'));
    }

    /**
     * Handles new video for saving to the database
     * @param VideosRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(VideosRequest $request)
    {
        $youtubeID = $this->video->getVideoUrl($request->youtubeID);
        if($youtubeID === 'error') {
            return redirect('/dashboard')->withErrors(['youtubeID' => 'The url is not a youtube video']);
        }
        $video_info = Youtube::getVideoInfo($youtubeID);
        if($video_info == false) {
            return redirect('/dashboard')->withErrors(['youtubeID' => 'This video does not exist']);
        }

        $data = $request->toArray();

        $data['category_id']  = $request->category;
        $data['user_id']  = Auth::user()->id;
        $data['youtubeID'] = $youtubeID;


        if($this->video->save($data)) {
            return redirect('/dashboard')->with('success', 'video added');
        } else {
            return redirect('/dashboard')->with('error', 'There was an error saving the video, check your form');
        }
    }


    /**
     * Handles and prepares data for updating video
     * @param VideosRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(VideosRequest $request)
    {
        //Get the video to be updated
        $video = $this->video->getVideoById($request->video_id);

        //Check if user is authorized to updated video
        $this->authorize('canUpdateOrDeleteVideo', $video);

        //Get get the youtube ID from the URL
        $youtubeID = $this->video->getVideoUrl($request->youtubeID);

        //Convert the request to array for saving
        $video_data = $request->toArray();

        //Add youtube ID to data to save
        $video_data['youtubeID'] = $youtubeID;

        //Update table
        $this->video->update($video_data, $request->video_id);

        //Return to view
        return redirect('/videos/'.$request->video_id.'/edit')->with('success', 'Video updated');
    }

    /**
     * Prepares & handles delete of video
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function destroy(Request $request)
    {
        //Get video to be deleted
        $video = $this->video->getVideoById($request->video_id);

        //Check to see if user is authorized to delete
        $this->authorize('canUpdateOrDeleteVideo', $video);

        //Delete the video
        $this->video->deleteVideo($request->video_id);

        //return to view
        return redirect('/dashboard')->with('success', 'Video deleted');
    }

    /**
     * Handles AJAX request to add a video as favourite
     * @param Requests\FavouritesVideoRequest $request
     * @return int
     */
    public function favourite(Requests\FavouritesVideoRequest $request)
    {
        //set type of response, 0 for un-like, 1 for like
        $type = 0;

        //Check if user has liked video
        if($this->favourite->hasUserLikedVideo( $request->video_id, Auth::user()->id)) {
            //Unlike video for users who have liked video originally
            $this->favourite->unlikeVideo($request->video_id, Auth::user()->id);
        } else {
            //Like video and set type =1 for users who have not liked video
            $this->favourite->likeVideo($request->video_id, Auth::user()->id);
            $type = 1;
        }

        return $type;
    }
}
