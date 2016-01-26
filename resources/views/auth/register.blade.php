@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col m8 offset-m2">
            {!! Form::open(['url'=>url('/register')]) !!}
                {!! csrf_field() !!}
                @include('partials.forms._profile')
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
                @include('auth.partials._socialAuthIcons')
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
