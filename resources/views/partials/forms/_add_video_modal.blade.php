<div id="add-video-modal">
    <div  id="btn-close-modal" class="close-add-video-modal">
        <i class="fa fa-times"></i>
    </div>

    <div class="modal-content">

        {!! Form::open(['url'=>'/videos/']) !!}
            @include('partials.forms._video')
        {!! Form::close() !!}
    </div>
</div>