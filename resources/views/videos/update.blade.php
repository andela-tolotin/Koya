@extends('layouts.app')

@section('content')
    {!! Form::open(['url'=>'/videos/'.$video->id.'/', 'method'=>'put']) !!}
        @include('partials.forms._video')
    {!! Form::close() !!}
@endsection

@section('custom-scripts')
    @include('partials.forms._add_video_modal')
    <script src="{{asset('/js/dashboard.js')}}"></script>
@endsection