@extends('layouts.app')
@section('custom-style')
@endsection

@section('navbar')
    @include('partials.navbars._navbar')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-xs-12 col-md-12 ">
                <h3 class="header">
                    <span class="pull-left">Categories</span>
                    <span class="pull-right">
                        <a href="{{url('/categories/create')}}" class="btn btn-primary">Create new category</a>
                    </span>
                    <br/>
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col col-xs-12 col-md-12">

            </div>
        </div>
        <div class="row">
            @foreach($categories as $category)
                <div class="col col-md-3">
                    <div class="category-card">
                        <a href="/categories/{{$category->id}}">
                            {!! cl_image_tag($category->cloudinary_id, ['crop'=>'thumb', 'class'=>'category'])!!}

                            <div class="panel-info">
                                {{--<a href="">--}}
                                <span>{{$category->label}}</span>
                                <span class="pull-right">
                                    <i class="fa fa-folder-o"></i>
                                    <span>2k+ videos</span>
                                </span>
                                {{--</a>--}}
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