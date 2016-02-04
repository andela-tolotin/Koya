@extends('layouts.app')
@section('navbar')
    <link rel="stylesheet" href="{!! URL::asset('css/landing_page.css') !!}">

@endsection
@section('content')
    @include('partials.navbars._home_navbar_bootstrap')

    <div class="container">
        <div class="row">
            @foreach($videos as $video)
                <div class="col col-md-3">
                    <div class="category-card">
                        <a href="/videos/{{$video->id}}">
                            {{--                            {!! cl_image_tag($video->cloudinary_id, )!!}--}}
                            {!! cl_image_tag("http://img.youtube.com/vi/$video->youtubeID/hqdefault.jpg",
                             ['crop'=>'thumb', 'class'=>'category', 'width'=>50])  !!}
                            <div class="panel-info">
                                <span>{{$video->title}}</span>
                                <span class="pull-right">
                                    <span>
                                        {{count($video->comments)}}
                                        <i class="fa fa-comment"></i>
                                        &nbsp;
                                        {{count($video->favourites)}}
                                        <i class="fa fa-heart fa-red-heart"></i>
                                    </span>
                                </span>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12 col-xs-12 col text-center">
                <a href="{{url('/categories/')}}" class="btn btn-primary">See More</a>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')
    <script type="text/javascript">
        $(function() {
            $('.dropdown-toggle').dropdown();
            $('.dropdown input, .dropdown label').click(function(e) {
                e.stopPropagation();
            });
        });
    </script>
@endsection
