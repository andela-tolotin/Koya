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









        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Register</div>--}}
                {{--<div class="panel-body">--}}
                    {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">--}}
                        {{--{!! csrf_field() !!}--}}

                        {{--<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">--}}
                            {{--<label class="col-md-4 control-label">Name</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input type="text" class="form-control" name="name" value="{{ old('name') }}">--}}

                                {{--@if ($errors->has('name'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('name') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                            {{--<label class="col-md-4 control-label">E-Mail Address</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input type="email" class="form-control" name="email" value="{{ old('email') }}">--}}

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
                            {{--<label class="col-md-4 control-label">Password</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input type="password" class="form-control" name="password">--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">--}}
                            {{--<label class="col-md-4 control-label">Confirm Password</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input type="password" class="form-control" name="password_confirmation">--}}

                                {{--@if ($errors->has('password_confirmation'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password_confirmation') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--<i class="fa fa-btn fa-user"></i>Register--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
</div>
@endsection
