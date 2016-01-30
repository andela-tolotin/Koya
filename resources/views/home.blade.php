@extends('layouts.app')

@section('content')
    <div class="row">
        @foreach($videos as $video)
            <div class="col m3">
                <a href="{{url('/videos/'.$video->id)}}">
                    <img width="50" src="http://img.youtube.com/vi/{!!$video->youtubeID !!}/hqdefault.jpg"/>
                    {{$video->title}}
                </a>
            </div>
        @endforeach
        <div class="col m12">
            {{$videos->render()}}
        </div>
    </div>
@endsection
