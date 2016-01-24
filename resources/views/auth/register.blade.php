@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col m8 offset-m2">
            {!! Form::open(['url'=>url('/register')]) !!}
                {!! csrf_field() !!}
                <div class="input-field">
                    {!! Form::label('name', 'Name')!!}
                    {!! Form::text('name', old('name'))!!}
                    @if($errors->has('name'))
                        <span class="red-text">{{$errors->first('name')}}</span>
                    @endif
                </div>
                <div class="input-field">
                    {!! Form::label('email', 'Email Address') !!}
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
                    {!! Form::label('password_confirmation', 'Confirm Password') !!}
                    {!! Form::password('password_confirmation') !!}
                    @if($errors->has('password_confirmation'))
                        <span class="red-text">{{$errors->first('password_confirmation')}}</span>
                    @endif
                </div>
                <div class="input-field">
                    {!! Form::submit('Register', ['class'=>'btn']) !!}
                </div>

                <div class="input-field">
                    {!!  html_entity_decode(link_to(url('#'), '<span class="fa fa-facebook fa-3x"></span>'))!!}
                    {!!  html_entity_decode(link_to(url('#'), '<span class="fa fa-github fa-3x"></span>'))!!}
                    {!!  html_entity_decode(link_to(url('#'), '<span class="fa fa-twitter fa-3x"></span>'))!!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
