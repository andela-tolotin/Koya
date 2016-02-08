<?php

namespace Koya\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Koya\Http\Requests\CommentsRequest;
use Koya\Repositories\CommentRepository;
use Koya\Repositories\VideoRepository;

/**
 * Class CommentsController.
 */
class CommentsController extends Controller
{
    /**
     * Initializes all dependencies for the class
     * CommentsController constructor.
     *
     * @param CommentRepository $commentRepository
     * @param VideoRepository   $videoRepository
     */
    public function __construct(CommentRepository $commentRepository, VideoRepository $videoRepository)
    {
        $this->commentRepository = $commentRepository;
        $this->videRepository = $videoRepository;
    }

    /**
     * Saves a new comment.
     *
     * @param CommentsRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function store(CommentsRequest $request)
    {
        //Get the video on which comment is being made
        $video = $this->videRepository->getVideoById($request->video_id);
        if ($video != null) {
            //Convert request to array for saving to database
            $data = $request->toArray();
            $data['user_id'] = Auth::user()->id;
            //Save comment
            $comment = $this->commentRepository->save($data);

            if ($comment) {
                //Prepare data for AJAX calls
                $data = $this->commentRepository->getCommentByID($comment->id);
                $created_at = $data->created_at->diffForHumans();
                $data = $data->toArray();
                $data['created_at'] = $created_at;
                //Return JSON if ajax call, else redirect to videos page
                return $request->ajax() ? json_encode($data) : redirect('/videos/'.$request->video_id.'/#'.$comment->id);
            }

            //If error saving return error to user
            return redirect('/videos/'.$request->video_id)->with('error', 'Error saving comment');
        }

        //Return to dashboard if video does not exist
        return redirect('/dashboard');
    }
}
