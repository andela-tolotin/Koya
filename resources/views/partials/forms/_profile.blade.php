<div class="form-group">
    {!! Form::label('name', 'Name', ['class'=>'visible-xs'])!!}
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-user"></i></span>
        {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder'=>'Your full name'])!!}
    </div>
    @if($errors->has('name'))
        <span class="red-text">{{$errors->first('name')}}</span>
    @endif
</div>
<div class="form-group">
    {!! Form::label('email', 'Email Address', ['class'=>'visible-xs']) !!}
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
        {!! Form::text('email', old('email'), ['class' => 'form-control','placeholder'=>'Email address']) !!}
    </div>
    @if($errors->has('email'))
        <span class="red-text">{{$errors->first('email')}}</span>
    @endif
</div>

<div class="form-group">
    {!! Form::label('username', 'Username', ['placeholder'=>'Username', 'class'=>'visible-xs']) !!}
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-circle-o"></i></span>
        {!! Form::text('username', old('username'), ['class' => 'form-control', 'placeholder'=>'Username']) !!}
    </div>
    @if($errors->has('username'))
        <span class="red-text">{{$errors->first('username')}}</span>
    @endif
</div>