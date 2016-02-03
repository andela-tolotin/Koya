@extends('layouts.app')
@section('custom-style')
    <link rel="stylesheet" href="{{URL::asset('css/video-page.css')}}">
@endsection

@section('navbar')
    @include('partials.navbars._navbar')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-xs-12 col-md-12 ">
                <h3 class="header">
                    <span >{{strtoupper($category->label)}}</span>
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col col-xs-12 col-md-12">

            </div>
        </div>
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
    </div>
@endsection

@section('custom-script')
    <script type="application/javascript">
        $('.category').onmouseover(function(){

        });
    </script>
@endsection