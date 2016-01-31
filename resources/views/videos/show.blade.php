@extends('layouts.app')

@section('content')
    <div class="content">
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
        {{Form::open(['url' => '/comments/', 'id'=>'commentsForm'])}}
            <div class="input-field">
                <label>Comment</label>
                <textarea name='comment' rows=40 id="comment"></textarea>
                <input type="hidden" name="video_id" value="{{$video->id}}" id="video_id"/>
                <button type="submit" class="btn"><i class="fa fa-comment"></i></button>

            </div>
        {{Form::close()}}
        <ul class="comments" id="commentsSection">
            @foreach($video->comments as $comment)
                {{--{{dd($comment->toArray())}}--}}
                <li>
                    <span>{{$comment->user->name}} | {{$comment->created_at->diffForHumans()}}</span>
                    <p>{{$comment->comment}}</p>
                </li>
            @endforeach
        </ul>
    @endsection

    @section('custom-scripts')
        <script src="{{asset('/js/jquery.jscroll.min.js')}}"></script>
            <script type="text/javascript">
            $.ajaxSetup({ headers: { '_token' : '{{ csrf_token() }}' } });
//            $('.comments').jscroll({
//            loadingHtml: '<i class="fa fa-spinner fa-spin"></i> Loading...',
//            padding: 20,
//            nextSelector: 'a.jscroll-next:last',
//            contentSelector: 'li'
//            });
            </script>
            <script src="{{asset('/js/video.js')}}"></script>
    </div>
@endsection