<div class="row">
    <div class="col s12">
        <h3 class="header">Category</h3>
    </div>
</div>
<div class="row">
    <div class="col m3 item">
        <div class="category item">
            <div class="category-image">
                <img src="{{load_asset('images/reactjs-logo.png')}}"/>
            </div>
            <div class="category-info reachJs">
                <span class="category-name">ReactJS</span>
                <span class="category-count pull-right">972 videos</span>
            </div>
        </div>
    </div>
    <div class="col m3 item">
        <div class="category item">
            <div class="category-image">
                <img src="{{load_asset('images/angularjs.png')}}"/>
            </div>
            <div class="category-info angularJS">
                <span class="category-name">AngularJS</span>
                <span class="category-count pull-right">2 videos</span>
            </div>
        </div>
    </div>
    <div class="col m3 item">
        <div class="category item">
            <div class="category-image">
                <img src="{{load_asset('images/php.png')}}"/>
            </div>
            <div class="category-info php">
                <span class="category-name">PHP</span>
                <span class="category-count pull-right">2 videos</span>
            </div>
        </div>
    </div>

    <div class="col m3 item">
        <div class="category item">
            <div class="category-image">
                <img src="{{load_asset('images/python.png')}}"/>
            </div>
            <div class="category-info python">
                <span class="category-name">Python</span>
                <span class="category-count pull-right">2 videos</span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    {{--Ruby--}}
    <div class="col m3 item">
        <div class="category">
            <div class="category-image">
                <img src="{{load_asset('images/ruby.png')}}"/>
            </div>
            <div class="category-info ruby">
                <span class="category-name">Ruby</span>
                <span class="category-count pull-right">2 videos</span>
            </div>
        </div>
    </div>

    {{--Node--}}
    <div class="col m3 item">
        <div class="category item">
            <div class="category-image">
                <img src="{{load_asset('images/node.png')}}"/>
            </div>
            <div class="category-info node">
                <span class="category-name">Node</span>
                <span class="category-count pull-right">2 videos</span>
            </div>
        </div>
    </div>

    {{--Java--}}
    <div class="col m3 item">
        <div class="category">
            <div class="category-image">
                <img src="{{load_asset('images/java.png')}}"/>
            </div>
            <div class="category-info java">
                <span class="category-name">Java</span>
                <span class="category-count pull-right">2 videos</span>
            </div>
        </div>
    </div>

    {{--HTMl--}}
    <div class="col m3 item">
        <div class="category ">
            <div class="category-image">
                <img src="{{load_asset('images/html.png')}}"/>
            </div>
            <div class="category-info html">
                <span class="category-name">HTML</span>
                <span class="category-count pull-right">2 videos</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div id="most-viewed" class="col m6 videos-images">
        Major
    </div>
    <div class="col m6 videos-images">
        <div class="row">
            <div class="col m4 videos-images">1</div>
            <div class="col m4 videos-images">2</div>
            <div class="col m4 videos-images">3</div>
        </div>
        <div class="row">
            <div class="col m4 videos-images">4</div>
            <div class="col m4 videos-images">5</div>
            <div class="col m4 videos-images">6</div>
        </div>
    </div>
</div>
<div class="row">
    @foreach($videos as $video)
        <div class="col m3">
            <a href="{{url('/videos/'.$video->id)}}">
                <img width="50" src="http://img.youtube.com/vi/{!!$video->youtubeID !!}/hqdefault.jpg"/>
                {{$video->title}}
            </a>
        </div>
    @endforeach
    <div class="col m12">
        {{$videos->render()}}
    </div>
</div>