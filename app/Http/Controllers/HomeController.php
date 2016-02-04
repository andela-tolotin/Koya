<?php

namespace Koya\Http\Controllers;

use Koya\Http\Requests;
use Illuminate\Http\Request;
use Koya\Libraries\Cloudinary;
use Koya\Repositories\VideoRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     * HomeController constructor.
     * @param VideoRepository $videoRepository
     * @param Cloudinary $cloudinary
     */
    public function __construct(VideoRepository $videoRepository, Cloudinary $cloudinary)
    {
        $this->videoRepo = $videoRepository;
        $this->cloudinary = $cloudinary;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = $this->videoRepo->getTopEight();
        return view('home', compact('videos'));
    }
}
