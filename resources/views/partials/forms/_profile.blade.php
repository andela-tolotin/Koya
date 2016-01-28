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
    {!! Form::label('username', 'Username') !!}
    {!! Form::text('username', old('username')) !!}
    @if($errors->has('username'))
        <span class="red-text">{{$errors->first('username')}}</span>
    @endif
</div>

<div class="input-field">
    {!! Form::select('category') !!}
</div>
