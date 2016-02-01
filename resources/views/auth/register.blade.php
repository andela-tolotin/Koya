@extends('layouts.app')
@section('custom-style')
    <link rel="stylesheet" href="{!! URL::asset('css/registration.css') !!}">
@endsection

@section('navbar')
    @include('partials.navbars._navbar')
@endsection
@section('content')

<div class="container">
    <div class="row body">
        <div class="col col-md-4  col-md-offset-2 reg-form">
            <h3 class="header text-center">Register your account</h3>
            {!! Form::open(['url'=>url('/register')]) !!}
                {!! csrf_field() !!}
                @include('partials.forms._profile')
                <div class="form-group">
                    {!! Form::label('password', 'Password', ['class'=>'visible-xs']) !!}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder'=>'Password']) !!}
                    </div>
                    @if($errors->has('password'))
                        <span class="red-text ">{{$errors->first('password')}}</span>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'Confirm Password', ['class'=>'visible-xs']) !!}
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-unlock"></i></span>
                        {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder'=>'confirm password']) !!}
                    </div>
                    @if($errors->has('password_confirmation'))
                        <span class="red-text">{{$errors->first('password_confirmation')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::submit('Register', ['class'=>'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
        <div class="col col-md-1"></div>
        <div class="col col-md-3 social-auth-icons">
            <h3 class="header text-center">OR</h3>
           <a class="btn btn-block btn-social btn-facebook" href="{{url('facebook/authorize')}}">
                <span class="fa fa-facebook"></span> Sign in with Facebook
            </a>
            <a class="btn btn-block btn-social btn-github" href="{{url('github/authorize')}}">
                <span class="fa fa-github "></span> Sign in with Github
            </a>
            <a class="btn btn-block btn-social btn-twitter" href="{{url('twitter/authorize')}}">
                <span class="fa fa-twitter"></span> Sign in with twitter
            </a>
        </div>
    </div>
</div>
@endsection
