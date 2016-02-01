{!! Form::open(['url' => '/login']) !!}
{!! csrf_field() !!}
<div class="form-group">
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', old('email'), ['class' => 'form-control']) !!}
    @if($errors->has('email'))
        <span class="red-text">{{$errors->first('email')}}</span>
    @endif
</div>
<div class="form-group">
    {!! Form::label('password', 'Password') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
    @if($errors->has('password'))
        <span class="red-text">{{$errors->first('password')}}</span>
    @endif
</div>
<div >
    {!! Form::submit('Login', ['class'=>'btn btn-primary']) !!}
    {!! Form::checkbox('remember', 0, false, array('id'=>'remember')) !!}
    {!! Form::label('remember', 'Remember Me', ['class'=>'remember-me']) !!}

</div>
<div class="form-group">
    {{link_to(url('/password/reset'),'Forgot Your Password?', ['class'=>'forgot-pass'])}}
</div>
@include('auth.partials._socialAuthIcons')
{!! Form::close()!!}