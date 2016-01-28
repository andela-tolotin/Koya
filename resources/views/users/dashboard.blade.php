@extends('layouts.app')

@section('content')

    @if(count($videos) > 0)
    <ul>
        {{link_to('#add-video-modal','Add Video', ['id' => 'add-video-modal-trigger'])}}
        @foreach($videos as $video)
            <li>
                <a href="#">
                    {{$video->link}}<br/>
                    {{$video->title}}<br/>
                    {{$video->user->name}}
                </a>
                <p>
                    {{$video->description}}
                </p>
            </li>
        @endforeach
    </ul>
    @else
        <h3 class="text-muted">You have no videos yet</h3>
        {{link_to('#add-video-modal','Upload your first video', ['id' => 'add-video-modal-trigger'])}}
    @endif


@endsection

@section('custom-scripts')
    @include('partials.forms._add_video_modal')
    <script src="{{asset('/js/dashboard.js')}}"></script>
@endsection