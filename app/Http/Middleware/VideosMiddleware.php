<?php

namespace Koya\Http\Middleware;

use Closure;
use Koya\Repositories\VideoRepository;
use Alaouy\Youtube\Facades\Youtube;

class VideosMiddleware
{
    public function __construct(VideoRepository $videoRepository)
    {
        $this->video = $videoRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Get the youtube ID from the video url
        $youtubeID = $this->video->getVideoUrl($request->youtubeID);

        //Return error if link is not valid
        if($youtubeID === 'error') {
            return redirect('/videos/'.$request->video_id.'/edit')->withErrors(['youtubeID' => 'The url is not a youtube video']);
        }

        //Get information about the video with valid Youtube ID
        $video_info = Youtube::getVideoInfo($youtubeID);

        //Check if the video actually exists
        if($video_info == false) {
            return redirect('/videos/'.$request->video_id.'/edit')->withErrors(['youtubeID' => 'This video does not exist']);
        }
        return $next($request);
    }
}
