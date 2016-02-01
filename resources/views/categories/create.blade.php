@extends('layouts.app')
@section('custom-style')
@endsection

@section('navbar')
    @include('partials.navbars._navbar')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-xs-12 col-md-4 col-md-offset-3">
                <h3 class="header">Create a new category</h3>
                {!! Form::open(['url' => '/categories', 'files'=>true]) !!}
                {!! csrf_field() !!}
                <div class="form-group">
                    {!! Form::label('label', 'Category name', ['class' => 'visible-xs']) !!}
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                        {!! Form::text('label', old('category'), ['class' => 'form-control', 'placeholder'=>'Category name']) !!}
                    </div>
                    @if($errors->has('label'))
                        <span class="red-text">{{$errors->first('label')}}</span>
                    @endif
                </div>
                <div class="form-group ">
                    {!! Form::label('upload', 'Category image') !!}
                        {!! Form::file('image', old('image'), ['class' => 'form-control']) !!}
                    @if($errors->has('label'))
                        <span class="red-text">{{$errors->first('image')}}</span>
                    @endif
                </div>
                <div >
                    {!! Form::submit('create', ['class'=>'btn btn-primary']) !!}
                </div>
                {!! Form::close()!!}
            </div>
        </div>
    </div>
@endsection