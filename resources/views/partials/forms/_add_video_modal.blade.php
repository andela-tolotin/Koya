<div id="add-video-modal">
    <div  id="btn-close-modal" class="close-add-video-modal">
        <i class="fa fa-times"></i>
    </div>

    <div class="modal-content">
        {!! Form::open(['url'=>'/videos/']) !!}
            <div class="input-field">
                <i class="fa fa-link prefix"></i>
                {!! Form::text('video-link') !!}
                <label for="video-link"> Video Link</label>
            </div>
            <div class="input-field">
                <i class="fa fa-video-camera prefix"></i>
                {!! Form::text('video-title') !!}
                <label for="video-title"> Video Link</label>
            </div>
            <div class="input-field">
                <i class="fa fa-info prefix"></i>
                {!! Form::textarea('video-description') !!}
                <label for="video-description"> Description</label>
            </div>
        {!! Form::close() !!}
    </div>
</div>