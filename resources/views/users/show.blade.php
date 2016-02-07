@extends('layouts.app')
@section('custom-style')
    <link rel="stylesheet" href="{{load_asset('css/dashboard.css')}}">
    <style type="text/css">
        .image_cover{
            background: url("{!! str_replace("src='",'', substr(cl_image_tag($user->cloudinary_id,
                            ['effect'=>'blur:1800']), strpos(cl_image_tag($user->cloudinary_id,
                            ['effect'=>'blur:1800']), 'src='), -4)) !!}") no-repeat;
            background-size: cover;
            text-align: center;
            text-shadow: 1px 1px 4px #FFF;
            margin-top:-20px;
            height: 100%;
        }

        .profile_holder{
            position: relative;
            top:250px;
        }
    </style>
@endsection

@section('navbar')
    @include('partials.navbars._navbar')
@endsection

@section('content')
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            <div class="image_cover">
                <div class='profile_holder'>
                    {!! cl_image_tag($user->cloudinary_id,
                    ['radius'=>'max', 'width'=>'200', 'height'=>'200', 'crop' => 'fill',
                                                    'gravity' => 'face', 'id'=>'user-avatar']) !!}
                    <h3>{{$user->name}}</h3>
                    <h4>{{$user->email}}</h4>
                    <h5>Date Joined: {{$dateFromNow}}</h5>
                    @if(Auth::check() && Auth::user()->username == $user->username)
                        {{link_to(url($user->username.'/edit'), 'Edit your profile', ['class'=>'btn btn-primary'])}}
                    @endif
                {{--</div>--}}
            {{--</div>--}}

        </div>
    </div>
@endsection

{{--{!! cl_image_tag($user->cloudinary_id,--}}
                            {{--['effect'=>'blur:1800', 'id'=>'blur_background']) !!}--}}