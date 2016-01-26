@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col m8 offset-m2">
            {!! Form::open(['url' => '/login']) !!}
                {!! csrf_field() !!}
                <div class="input-field">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::text('email', old('email')) !!}
                    @if($errors->has('email'))
                        <span class="red-text">{{$errors->first('email')}}</span>
                    @endif
                </div>
                <div class="input-field">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password') !!}
                    @if($errors->has('password'))
                        <span class="red-text">{{$errors->first('password')}}</span>
                    @endif
                </div>
                <div class="input-field">
                    {!! Form::checkbox('remember', 0, false, array('id'=>'remember')) !!}
                    {!! Form::label('remember', 'Remember Me') !!}
                </div>
                <div class="input-field">
                    {!! Form::submit('Login', ['class'=>'btn']) !!}
                    {{link_to(url('/password/reset'),'Forgot Your Password?')}}
                </div>
            @include('auth.partials._socialAuthIcons')
            {!! Form::close()!!}
        </div>
    </div>
</div>
@endsection