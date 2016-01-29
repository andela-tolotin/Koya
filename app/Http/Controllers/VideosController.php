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


    public function edit(Request $request)
    {
        $video = $this->video->getVideoById($request->video_id);
        if($video != null) {
            $tags  = $this->video->generateTagsArray($this->video->getAllTags());
            $selected = array_keys($this->video->generateTagsArray($video->tags));
            return view('videos.update', compact('video', 'tags', 'selected'));
        }

        return abort(404, 'The video does not exist or has been moved');
    }

    public function update(VideosRequest $request)
    {
        $link = $this->video->getVideoUrl($request->link);
        if($link === 'error') {
            return redirect('/videos/'.$request->video_id.'/edit')->withErrors(['link' => 'The url is not a youtube video']);
        }

        $video = Youtube::getVideoInfo($link);
        if($video == false) {
            return redirect('/videos/'.$request->video_id.'/edit')->withErrors(['link' => 'This video does not exist']);
        }

        $video_data = $request->toArray();

        $video_data['link'] = $link;

        if($this->video->update($video_data, $request->video_id))
        {
            return redirect('/videos/'.$request->video_id.'/edit')->with('success', 'Video updated');
        }
        return redirect('/videos/'.$request->video_id.'/edit')->with('error', 'Error updating video, check form');

    }


    public function destroy(Request $request)
    {
        $this->video->deleteVideo($request->video_id);
        return redirect('/dashboard');
    }


}
