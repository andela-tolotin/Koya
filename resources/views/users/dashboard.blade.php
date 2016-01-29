@extends('layouts.app')

@section('content')
    @if(count($videos) > 0)
    <ul>
        {{link_to('#add-video-modal','Add Video', ['id' => 'add-video-modal-trigger'])}}
        @foreach($videos as $video)
            <li>
                <a href="{{url('/videos/'.$video->id)}}">
                    <img src="http://img.youtube.com/vi/{!!$video->youtubeID !!}/hqdefault.jpg"/>
                    {{$video->title}}<br/>
                    {{$video->user->name}}
                </a>
                <p>
                    {{$video->description}}
                </p>
                <span>
                    <a href="#like"><i class="fa fa-heart-o"></i> [4] </a>
                    <a href="{{url('videos/'.$video->id.'/edit/')}}"><i class="fa fa-pencil"></i></a>

                    {{Form::open(['url'=>['videos/'.$video->id.'/delete'], 'method'=>'delete', 'class'=>'deleteForm'])}}
                        <button type="submit"  id="delete-button"><i class="fa fa-trash-o"></i></button>
                    {{Form::close()}}
                </span>
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
    <script type="text/javascript">
        $('.deleteForm').submit(function(e){
            e.preventDefault();
            var form = this;
            swal({
                title:"Are you sure?",
                text:"You will not be able to recover deleted video",
                type:'warning',
                showCancelButton:true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if(isConfirm) {
                    form.submit();
                } else {
                    swal("Cancelled", "Delete cancelled", "error");
                }
            });
        });
    </script>
@endsection