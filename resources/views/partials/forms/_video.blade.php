<div class="form-group">
    <i class="fa fa-youtubeID prefix"></i>
    <label for="youtubeID" class="visible-xs"> Video youtubeID</label>
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-link"></i></span>
        {!! Form::text('youtubeID', isset($video->youtubeID) ? "https://www.youtube.com/embed/".$video->youtubeID : null,
            ['class'=>'form-control', 'placeholder' => 'Youtube URL']  )!!}
    </div>
    @if($errors->has('youtubeID'))
        <span class="red-text">{{$errors->first('youtubeID')}}</span>
    @endif
</div>


<div class="form-group">
    <label for="video-title" class="visible-xs"> Video Title</label>
    <div class="input-group">

        <span class=" input-group-addon"><i class="fa fa-film"></i></span>
        {!! Form::text('title', isset($video->title) ? $video->title : null,
            ['class'=>'form-control', 'placeholder'=>'Video Title']) !!}
    </div>
    @if($errors->has('title'))
        <span class="red-text">{{$errors->first('title')}}</span>
    @endif
</div>


<div class="form-group">
    <label for="video-description" class="visible-xs"> Category</label>
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-tag "></i></span>
        {!! Form::select('category', $categories, isset($selected) ? $selected : null,
        ['class'=>'form-control', 'placeholder'=>'Select video category'])!!}
    </div>

    @if($errors->has('category'))
        <span class="red-text">{{$errors->first('category')}}</span>
    @endif
</div>


<div class="form-group">
    <label for="description" class="visible-xs"> Description</label>
    <div class="input-group">
        {!! Form::textarea('description', isset($video->description) ? $video->description : null,
         ['class' => 'form-control', 'id' => 'description_textarea', 'placeholder'=>'Enter video description here']) !!}
    </div>
    @if($errors->has('description'))
        <span class="red-text">{{$errors->first('description')}}</span>
    @endif
</div>
<div class="input-field">
    {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
</div>