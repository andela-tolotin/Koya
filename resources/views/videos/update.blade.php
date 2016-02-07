@extends('layouts.app')
@section('custom-style')
@endsection

@section('navbar')
    @include('partials.navbars._navbar')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-xs-12 col-md-12">
                <h3 class="header">Edit video</h3>
            </div>
            <div class="col col-xs-12 col-md-4 col-md-offset-4">
                {!! Form::open(['url'=>'/videos/'.$video->id.'/', 'method'=>'put']) !!}
                @include('partials.forms._video')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

    @section('custom-scripts')
        @include('partials.forms._add_video_modal')
        <script src="{{load_asset('/js/dashboard.js')}}"></script>
    @endsection