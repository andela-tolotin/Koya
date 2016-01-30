<?php

namespace Koya\Http\Controllers;

use Koya\Http\Requests;
use Illuminate\Http\Request;
use Koya\Repositories\VideoRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepo = $videoRepository;
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = $this->videoRepo->getAllVideos();
        return view('home', compact('videos'));
    }
}
