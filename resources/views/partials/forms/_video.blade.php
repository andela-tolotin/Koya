<div class="input-field">
    <i class="fa fa-youtubeID prefix"></i>
    {!! Form::text('youtubeID', isset($video->youtubeID) ? "https://www.youtube.com/embed/".$video->youtubeID : null) !!}
    <label for="youtubeID"> Video youtubeID</label>
    @if($errors->has('youtubeID'))
        <span class="red-text">{{$errors->first('youtubeID')}}</span>
    @endif
</div>
<div class="input-field">
    <i class="fa fa-film prefix"></i>
    {!! Form::text('title', isset($video->title) ? $video->title : null) !!}
    <label for="video-title"> Video Title</label>
    @if($errors->has('title'))
        <span class="red-text">{{$errors->first('title')}}</span>
    @endif
</div>
<div class="input-field">
    <i class="fa fa-info prefix"></i>
    {!! Form::textarea('description', isset($video->description) ? $video->description : null, ['class' => 'materialize_textarea', 'id' => 'description_textarea']) !!}
    <label for="description"> Description</label>
    @if($errors->has('description'))
        <span class="red-text">{{$errors->first('description')}}</span>
    @endif
</div>
<div class="input-field">
    <i class="fa fa-tag"></i>
    {!! Form::select('tags[]', $tags, isset($selected) ? $selected : null, ['multiple' => true])!!}
    <label for="video-description"> Tag</label>
    @if($errors->has('tags'))
        <span class="red-text">{{$errors->first('tags')}}</span>
    @endif
</div>
<div class="input-field">
    {!! Form::submit('Save', ['class'=>'btn btn-submit']) !!}
</div>