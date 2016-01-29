@extends('layouts.app')

@section('content')
    <script data-cfasync="false">
        (function(r,e,E,m,b){E[r]=E[r]||{};E[r][b]=E[r][b]||function(){
                    (E[r].q=E[r].q||[]).push(arguments)};b=m.getElementsByTagName(e)[0];m=m.createElement(e);
            m.async=1;m.src=("file:"==location.protocol?"https:":"")+"//s.reembed.com/G-AoyGGn.js";
            b.parentNode.insertBefore(m,b)})("reEmbed","script",window,document,"api");
    </script>

    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$video->youtubeID}}" frameborder="0" allowfullscreen>
    </iframe>
    <a href="#like"><i class="fa fa-heart-o"></i> [4] </a>
    <h3>Comments</h3>
    {{Form::open(['url' => '/comments/'])}}
        <div class="input-field">
            <label>Comment</label>
            <textarea name='comment' rows=40></textarea>
            <input type="hidden" name="video_id" value="{{$video->id}}"/>
            <button type="submit" class="btn"><i class="fa fa-comment"></i></button>
        </div>
    {{Form::close()}}
    <ul>
        @foreach($video->comments as $comment)
            {{--{{dd($comment->toArray())}}--}}
            <li>
                <span>{{$comment->user->name}} | {{$comment->created_at->diffForHumans()}}</span>
                <p>{{$comment->comment}}</p>
            </li>
        @endforeach
    </ul>
@endsection