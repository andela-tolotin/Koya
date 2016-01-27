@extends('layouts.app')

@section('content')
    {!! Form::model(Auth::user(), [url(Auth::user()->username.'/edit'), 'enctype'=>'multipart/form-data', 'file'=>true, 'method' => 'PUT']) !!}
        <div class="input-field">
            {!! Form::file('image', ['name'=>'avatar']) !!}
            @if($errors->has('avatar'))
                <span class="red-text">{{$errors->first('avatar')}}</span>
            @endif
        </div>
        @include('partials.forms._profile')
        <div class="input-field">
            {!! Form::submit('Update', ['class'=>'btn']) !!}
        </div>
    {!! Form::close() !!}

@endsection