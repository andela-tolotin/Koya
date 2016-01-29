<?php

namespace Koya\Http\Controllers;

use Alaouy\Youtube\Facades\Youtube;
use Illuminate\Http\Request;
use Auth;

use Koya\Http\Requests;
use Koya\Http\Controllers\Controller;
use Koya\Http\Requests\VideosRequest;
use Koya\Libraries\Cloudinary;
use Koya\Repositories\VideoRepository;

class VideosController extends Controller
{
    public function __construct(VideoRepository $video, Cloudinary $cloudinary)
    {
        $this->video = $video;
        $this->cloudinary = $cloudinary;
    }

    public function store(VideosRequest $request)
    {
        $link = $this->video->getVideoUrl($request->link);
        if($link === 'error') {
            return redirect('/dashboard')->withErrors(['link' => 'The url is not a youtube video']);
        }
        $video = Youtube::getVideoInfo($link);


        if($video == false) {
            return redirect('/dashboard')->withErrors(['link' => 'This video does not exist']);
        }

        $thumbnail = $video->snippet->thumbnails->high->url;
        $cloudinary_id = $this->cloudinary->upload($thumbnail)['public_id'];
        $data = $request->toArray();
        $data['cloudinary_id'] = $cloudinary_id;
        $data['link'] = $link;
        $this->video->save($data, Auth::user()->id);
        return redirect('/dashboard');
    }

    public function destroy(Request $request)
    {
        $this->video->deleteVideo($request->video_id);
        return redirect('/dashboard');
    }
}
