<?php

namespace Koya\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Input;
use Koya\Http\Requests;
use Koya\Http\Controllers\Controller;
use Koya\Http\Requests\UserRequest;
use Koya\Repositories\UserRepository;

class UsersController extends Controller
{
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function show($route_username)
    {
        $user = $this->user->getUserByUsername($route_username);
        $dateFromNow = $user->created_at->diffForHumans();
        return view('users.show', compact('user', 'dateFromNow'));
    }
    public function edit($route_username)
    {
        $this->authorize('update', $this->user->getUserByUsername($route_username));
        return view('users.edit');
    }

    public function update(UserRequest $request)
    {
        dd(Input::file($request->avatar));
        $data = $request->toArray();

        dd($data);
        $user = $this->user->getUserByUsername($request->username);
        dd($request->toArray());
    }
}
