<div id="add-video-modal">
    <div class="row">
        <div class="col col-md-2 col-xs-12 pull-right">
            <div  id="btn-close-modal" class="close-add-video-modal fa-3x">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <div class="col col-md-12 text-center text-muted ">
            <h3 class="header">
                <i class="fa fa-video-camera"></i>
                Add video</h3>
        </div>
        <div class="col col-xs-12 col-md-5 col-md-offset-3">
            <div class="modal-form">

                {!! Form::open(['url'=>'/videos/']) !!}
                    @include('partials.forms._video')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>