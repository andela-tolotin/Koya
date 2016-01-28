@extends('layouts.app')

@section('content')
    {{link_to('#add-video-modal','Add Video', ['id' => 'add-video-modal-trigger'])}}
    @include('partials.forms._add_video_modal')
@endsection

@section('custom-scripts')
<script>

    //demo 02
    $("#add-video-modal-trigger").animatedModal({
        modalTarget:'add-video-modal',
        animatedIn:'bounceInUp',
        animatedOut:'bounceOutDown',
        color:'#FFF',
        opacity:0.2,
        beforeOpen: function() {

            var children = $(".thumb");
            var index = 0;

            function addClassNextChild() {
                if (index == children.length) return;
                children.eq(index++).show().velocity("transition.slideRightIn", { opacity:1, stagger: 450,  defaultDuration: 100 });
                window.setTimeout(addClassNextChild, 100);
            }

            addClassNextChild();

        },
        afterOpen: function() {
            console.log("The animation is completed");
        },
        beforeClose: function() {
            console.log("The animation was called");
        },

        afterClose: function() {
            $(".thumb").hide();
        }
    });

</script>




@endsection