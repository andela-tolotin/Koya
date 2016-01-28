<?php

namespace Koya\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use Koya\Http\Requests;
use Koya\Http\Controllers\Controller;
use Koya\Http\Requests\VideosRequest;
use Koya\Repositories\VideoRepository;

class VideosController extends Controller
{
    public function __construct(VideoRepository $video)
    {
        $this->video = $video;
    }

    public function create(VideosRequest $request)
    {
        $this->video->save($request->toArray(), Auth::user()->id);
        return redirect('/dashboard');
    }
}
