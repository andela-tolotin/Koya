@extends('layouts.app')
@section('custom-style')
    <link rel="stylesheet" href="{{load_asset('css/video-page.css')}}">
@endsection

@section('navbar')
    @include('partials.navbars._navbar')
@endsection
@section('content')
    <script data-cfasync="false">
        (function(r,e,E,m,b){E[r]=E[r]||{};E[r][b]=E[r][b]||function(){
                    (E[r].q=E[r].q||[]).push(arguments)};b=m.getElementsByTagName(e)[0];m=m.createElement(e);
            m.async=1;m.src=("file:"==location.protocol?"https:":"")+"//s.reembed.com/G-AoyGGn.js";
            b.parentNode.insertBefore(m,b)})("reEmbed","script",window,document,"api");
    </script>
    <div class="youtubePlayer">
        <div class="frame">
            <iframe src="https://www.youtube.com/embed/{{$video->youtubeID}}?autoplay=1&cc_load_policy=1&color=white&theme=light"
                width="560" height="345" frameborder="0" allowfullscreen=""></iframe>
            <div class='video_info'>
                <span class="video-title"> {{$video->title}} </span>
                {{Form::open(['url' => "/videos/$video->id/favourite",
                'method'=>'put',
                'class'=>'form-inline'])}}
                <input type="hidden" class='form-control' name="video_id" value="{{$video->id}}" id="video_id"/>
                <button href="javascript:void(0)" type="submit" class="btn-heart" id="addFavourite" >
                    <i class="fa fa-heart
                            {{ (Auth::check() && $video->favourites->contains('user_id', Auth::user()->id)) ? 'fa-red-heart' : ''}}"></i>
                </button>
                <span id="video_count">{{number_format(count($video->favourites))}} </span>
                {{Form::close()}}
            </div>


        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col col-xs-12 col-md-6 col-md-offset-2">
                <div class="row">
                    <div class="col col-xs-12 col-md-10 ">
                        <h4 class="header">Comments</h4>
                        @can('comment')
                        {{Form::open(['url' => '/comments/', 'id'=>'commentsForm'])}}
                            <div class="form-group comment-wrapper ">
                                <label class="visible-xs">Comment</label>
                                <div class="avatar comment-avatar">
                                    @if(Auth::user()->cloudinary_id)
                                        {!! cl_image_tag(Auth::user()->cloudinary_id,
                                            ['width'=>80, 'height'=>80,'crop' => 'fill',
                                                        'gravity' => 'face' ]) !!}
                                    @else
                                        <i class="fa fa-user fa-5x"></i>
                                    @endif
                                </div>
                                <input type="hidden" class='form-control' name="video_id" value="{{$video->id}}" id="video_id"/>
                                <textarea name='comment' id="comment" placeholder="Write your comment here"></textarea>
                            </div>
                            @if($errors->has('comment'))
                                <span class="red-text">{{$errors->first('comment')}}</span>
                            @endif
                            <button type="submit" class="btn btn-primary pull-right"> Post</button>
                        {{Form::close()}}
                        @endcan
                    </div>
                </div>


        <div id="comments-wrapper">
            @if(count($video->comments) != 0)
                @foreach($video->comments as $comment)
                    <div class="single-comment comment-wrapper">
                        <div class="avatar thumb">
                            @if($comment->user->cloudinary_id)
                                {!! cl_image_tag($comment->user->cloudinary_id,
                                            ['width'=>48, 'height'=>48,'crop' => 'fill',
                                                        'gravity' => 'face' ]) !!}
                            @else
                                <img src="{{load_asset('images/avatar48x48.png')}}"/>
                            @endif
                        </div>
                        <div class="comment">
                            <div class="comment-meta">
                                <h4 class="header">
                                    <a href='{{url($comment->user->username)}}'>{{$comment->user->name}}</a></h4>
                                <span>{{$comment->created_at->diffForHumans()}}</span>
                            </div>
                            <p>
                                {{$comment->comment}}
                            </p>
                        </div>
                    </div>
                @endforeach

            @else
                <h3 class='header text-center'>Be the first to comment</h3>
                @if(!Auth::check())
                    <a class="btn btn-block btn-social btn-facebook" href="{{url('facebook/authorize')}}">
                        <span class="fa fa-facebook"></span> Sign in with Facebook
                    </a>
                    <a class="btn btn-block btn-social btn-github" href="{{url('github/authorize')}}">
                        <span class="fa fa-github"></span> Sign in with Github
                    </a>
                    <a class="btn btn-block btn-social btn-twitter" href="{{url('twitter/authorize')}}">
                        <span class="fa fa-twitter"></span> Sign in with twitter
                    </a>
                @endif
            @endif
        </div>
    </div>
</div>
    </div>
@endsection

@section('custom-scripts')
    <script src="{{load_asset('/js/jquery.jscroll.min.js')}}"></script>
    <script type="text/javascript">
        $.ajaxSetup({ headers: { '_token' : '{{ csrf_token() }}' } });
    </script>
    <script src="{{load_asset('/js/video.js')}}"></script>
@endsection