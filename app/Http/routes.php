<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::get('/', 'HomeController@index');
//    Route::get('/', function () {
//        return view('welcome');
//    });
    Route::auth();
    Route::get('{provider}/authorize', 'Auth\SocialAuthController@authorizeProvider');
    Route::get('{provider}/login', 'Auth\SocialAuthController@login');
    Route::get('/home', 'HomeController@index');

    Route::group(['middleware' => 'user_logged_in'], function(){
        Route::get('dashboard', 'UsersController@dashboard');
        Route::get('videos/{video_id}', 'VideosController@show');
        Route::post('videos', 'VideosController@store');
        Route::put('videos/{video_id}', 'VideosController@update');
        Route::get('videos/{video_id}/edit/', 'VideosController@edit');
        Route::delete('videos/{video_id}/delete/', 'VideosController@destroy');
        Route::post('comments/', 'CommentsController@store');
    });
    //Routes for accessing users
    Route::group(['middleware' => 'user'], function() {
        Route::get('/{route_username}/edit', 'UsersController@edit');
        Route::put('/{route_username}/edit', 'UsersController@update');
    });
    Route::get('/{route_username}/', 'UsersController@show');
});
