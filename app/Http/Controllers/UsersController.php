<?php

namespace Koya\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Auth;
use Koya\Http\Requests;
use Koya\Http\Requests\UserRequest;
use Koya\Libraries\Cloudinary;
use Koya\Repositories\CategoryRepository;
use Koya\Repositories\UserRepository;
use Koya\Repositories\VideoRepository;
use Koya\Video;
use Alert;

class UsersController extends Controller
{
    public function __construct
    (       UserRepository $user,
            VideoRepository $video, Cloudinary $cloudinary,
            CategoryRepository $categoryRepository)
    {
        $this->user = $user;
        $this->cloudinary = $cloudinary;
        $this->video = $video;
        $this->category = $categoryRepository;
    }

    public function show($route_username)
    {
        try{
            $user = $this->user->getUserByUsername($route_username);
            $dateFromNow = $user->created_at->diffForHumans();
            return view('users.show', compact('user', 'dateFromNow'));
        } catch (\Exception $ex) {
            return abort(404, 'Page not found');
        }
    }

    public function edit($route_username)
    {
        $this->authorize('update', $this->user->getUserByUsername($route_username));
        return view('users.edit');
    }

    public function update(UserRequest $request, $route_username)
    {
        $data = $request->toArray();
        if ($request->hasFile('avatar')) {
            $cloudinary_data = $this->cloudinary->upload($request->file('avatar'));
            $data['avatar'] = $cloudinary_data['url'];
            $data['cloudinary_id'] = $cloudinary_data['public_id'];
        }
        $this->user->update($data, $route_username);

        return redirect($data['username'].'/');
    }


    public function dashboard()
    {
        $videos = $this->video->getAllUserVideos(Auth::user()->id);
        $categories = $this->category->getAllCategories()->pluck('label');
        return view('users.dashboard', compact('videos', 'categories'));
    }

}
