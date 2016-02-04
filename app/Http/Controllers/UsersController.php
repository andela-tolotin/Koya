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

/**
 * Class UsersController
 * @package Koya\Http\Controllers
 */
class UsersController extends Controller
{
    /**
     * UsersController constructor.
     * Initializes all DI objects needed in the class
     * @param UserRepository $user
     * @param VideoRepository $video
     * @param Cloudinary $cloudinary
     * @param CategoryRepository $categoryRepository
     */
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

    /**
     * Shows a single user profile
     * @param $route_username
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
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

    /**
     * Edit controller for editing user information, displays edit form
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $this->authorize('update', $this->user->getUserByUsername($request->route_username));
        return view('users.edit');
    }

    /**
     * Updates name of user
     * @param UserRequest $request contains new user information to be updated
     * @param String $route_username contains old username to be updated
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UserRequest $request, $route_username)
    {
        //Convert request data to array
        $data = $request->toArray();
        if ($request->hasFile('avatar')) {
            //Upload user avatar to cloudinary if available
            $cloudinary_data = $this->cloudinary->upload($request->file('avatar'));
            //Get the new data and public id to save to the database
            $data['avatar'] = $cloudinary_data['url'];
            $data['cloudinary_id'] = $cloudinary_data['public_id'];
        }

        //Update the information to the database
        $this->user->update($data, $route_username);

        return redirect($data['username'].'/');
    }


    /**
     * Displays user homepage
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        //Get all Videos by logged in user
        $videos = $this->video->getAllUserVideos(Auth::user()->id);

        //get all categories of videos
        $categories = $this->category->getAllCategories()->pluck('label');

        //Load view
        return view('users.dashboard', compact('videos', 'categories'));
    }

}
