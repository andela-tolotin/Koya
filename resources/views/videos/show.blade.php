@extends('layouts.app')
@section('custom-style')
    <link rel="stylesheet" href="{{URL::asset('css/video-page.css')}}">
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
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col col-md-4  col-xs-12 col-md-offset-3 pull-right">
                <span>{{$video->title}}</span>
                <a href="#like"><i class="fa fa-heart-o fa-2x"></i> [4] </a>
            </div>

        </div>
        <div class="row">
            <div class="col col-xs-12 col-md-6 col-md-offset-2">
                <div class="row">
                    <div class="col col-xs-12 col-md-10 ">
                        <h4 class="header">Comments</h4>
                        {{Form::open(['url' => '/comments/', 'id'=>'commentsForm'])}}
                            <div class="form-group comment-wrapper ">
                                <label class="visible-xs">Comment</label>
                                <div class="avatar comment-avatar">
                                    <img src="http://lorempixel.com/48/48/"/>
                                </div>
                                <input type="hidden" class='form-control' name="video_id" value="{{$video->id}}" id="video_id"/>
                                <textarea name='comment' id="comment" placeholder="Write your comment here"></textarea>
                            </div>
                            @if($errors->has('comment'))
                                <span class="red-text">{{$errors->first('comment')}}</span>
                            @endif
                            <button type="submit" class="btn btn-primary pull-right"> Post</button>
                        {{Form::close()}}
                    </div>
                </div>


        <div id="comments-wrapper">
            @foreach($video->comments as $comment)
                <div class="single-comment comment-wrapper">
                    <div class="avatar thumb">
                        @if($comment->user->cloudinary_id)
                            <img src="http://lorempixel.com/48/48/"/>
                        @else
                            <img src="{{URL::asset('images/avatar48x48.png')}}"/>
                        @endif
                    </div>
                    <div class="comment">
                        <div class="comment-meta">
                            <h4 class="header">
                                <a href=#>{{$comment->user->name}}</a></h4>
                            <span>{{$comment->created_at->diffForHumans()}}</span>
                        </div>
                        <p>
                            {{$comment->comment}}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
    </div>
@endsection

@section('custom-scripts')
    <script src="{{asset('/js/jquery.jscroll.min.js')}}"></script>
    <script type="text/javascript">
        $.ajaxSetup({ headers: { '_token' : '{{ csrf_token() }}' } });
    </script>
    <script src="{{asset('/js/video.js')}}"></script>
@endsection