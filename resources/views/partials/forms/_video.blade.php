<div class="input-field">
    <i class="fa fa-link prefix"></i>
    {!! Form::text('link', isset($video->link) ? "https://www.youtube.com/embed/".$video->link : null) !!}
    <label for="link"> Video Link</label>
    @if($errors->has('link'))
        <span class="red-text">{{$errors->first('link')}}</span>
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