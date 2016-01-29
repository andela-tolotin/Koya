@extends('layouts.app')

@section('content')
    <script data-cfasync="false">
        (function(r,e,E,m,b){E[r]=E[r]||{};E[r][b]=E[r][b]||function(){
                    (E[r].q=E[r].q||[]).push(arguments)};b=m.getElementsByTagName(e)[0];m=m.createElement(e);
            m.async=1;m.src=("file:"==location.protocol?"https:":"")+"//s.reembed.com/G-AoyGGn.js";
            b.parentNode.insertBefore(m,b)})("reEmbed","script",window,document,"api");
    </script>

    @if(count($videos) > 0)
    <ul>
        {{link_to('#add-video-modal','Add Video', ['id' => 'add-video-modal-trigger'])}}
        @foreach($videos as $video)
            <li>
{{--                <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$video->link}}" frameborder="0" allowfullscreen>--}}
                </iframe>
                <a href="#">
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