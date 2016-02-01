<?php

namespace Koya\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Koya\Http\Requests;
use Koya\Http\Controllers\Controller;
use Koya\Http\Requests\CommentsRequest;
use Koya\Http\Requests\VideosRequest;
use Koya\Repositories\CommentRepository;
use Koya\Repositories\VideoRepository;

class CommentsController extends Controller
{
    public function __construct(CommentRepository $commentRepository, VideoRepository $videoRepository)
    {
        $this->commentRepository = $commentRepository;
        $this->videRepository = $videoRepository;
    }

    public function store(CommentsRequest $request)
    {
        $video = $this->videRepository->getVideoById($request->video_id);
        if($video != null) {
            $data = $request->toArray();
//            $data['user_id'] = Auth::user()->id || 1;
            $data['user_id'] = 1;
            $comment = $this->commentRepository->save($data);

            if($comment) {
                $data = $this->commentRepository->getCommentByID($comment->id);
                $created_at = $data->created_at->diffForHumans();
                $data = $data->toArray();
                $data['created_at'] = $created_at;
                return $request->ajax()? json_encode($data) : redirect('/videos/'.$request->video_id.'/#'.$comment->id);
            }

            return redirect('/videos/'.$request->video_id)->with('error', 'Error saving comment');
        }

        return redirect('/dashboard');
    }
}
