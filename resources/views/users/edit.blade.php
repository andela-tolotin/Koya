@extends('layouts.app')
@section('custom-style')
    <link rel="stylesheet" href="{{load_asset('css/dashboard.css')}}">
@endsection

@section('navbar')
    @include('partials.navbars._navbar')
@endsection

@section('content')
    <div class="row">
        <div class="col col-md-5 col-xs-12 col-md-offset-4">
            <h4 class="header">Edit your profile</h4>
            {!! Form::model(Auth::user(), [url(Auth::user()->username.'/edit'), 'enctype'=>'multipart/form-data', 'file'=>true, 'method' => 'PUT']) !!}
            <div class="input-field">
                {!! Form::file('image', ['name'=>'avatar']) !!}
                @if($errors->has('avatar'))
                    <span class="red-text">{{$errors->first('avatar')}}</span>
                @endif
            </div>
            @include('partials.forms._profile')
            <div class="input-field">
                {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
                <a href="{{url(Auth::user()->username) }}" class="btn btn-danger">Cancel</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection