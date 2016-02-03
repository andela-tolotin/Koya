@extends('layouts.app')
@section('custom-style')
    <link rel="stylesheet" href="{{URL::asset('css/dashboard.css')}}">
@endsection

@section('navbar')
    @include('partials.navbars._navbar')
@endsection


@section('content')
    <div class="container">
        @if(count($videos) > 0)
            <div class="row">
                <div class="col col-xs-12 col-md-4">
                    <a href="#add-video-modal" id="add-video-modal-trigger" class="btn btn-primary">
                        <i class="fa fa-cloud-upload "></i> Upload a video
                    </a>
                </div>
            </div>
            <div class="row">
                @foreach($videos as $video)
                    <div class="col col-md-3">
                        <div class="category-card">
                            <a href="/videos/{{$video->id}}" title="{{$video->title}}">
                                {!! cl_image_tag("http://img.youtube.com/vi/$video->youtubeID/hqdefault.jpg",
                                 ['crop'=>'thumb', 'class'=>'category', 'width'=>100])  !!}
                            </a>
                            <span class="video-title">
                                {{--{{$video->category->label}} --}} {{$video->title}}
                            </span>
                            <div class="panel-info">

                                <a href="{{url('videos/'.$video->id.'/edit/')}}"><i class="fa fa-pencil"></i></a>
                                {{Form::open(['url'=>['videos/'.$video->id.'/delete'], 'method'=>'delete', 'class'=>'deleteForm'])}}
                                <button type="submit"  id="delete-button"><i class="fa fa-trash-o"></i></button>
                                {{Form::close()}}
                                <span class="pull-right">

                                    <a href="#"> <i class="fa fa-comment"></i> {{count($video->comments)}}</a>
                                    &nbsp;
                                    <i class="fa fa-heart"></i>
                                    <a href="#">{{count($video->favourites)}}</a>
                                </span>
                            </div>
                        </div>

                    </div>
                @endforeach

                    <div class="row">
                        <div class="col col-md-12 text-center">{{$videos->render()}}</div>
                    </div>
            </div>
        @else
            <div class="row">
                <div class="col col-xs-12 col-md-5 col-md-offset-3 text-center">
                    <h3 class="text-muted">You have no videos yet</h3>
                    <a href="#add-video-modal" id="add-video-modal-trigger" class="btn btn-primary btn-block">
                        Upload your first video
                    </a>
                </div>
            </div>
        @endif

    </div>
@endsection

@section('custom-scripts')

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

@include('partials.forms._add_video_modal')