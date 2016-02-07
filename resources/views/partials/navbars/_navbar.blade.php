<nav class="navbar  navbar-primary">
    <div class="container">
        <a class="brand-logo" href="{{ url('/') }}">
            <img src="{{load_asset('images/logo.png')}}"/>
        </a>
        <ul class="nav navbar-nav navbar-right hidden-sm">
            <li><a href="{{url('/categories')}}" >Videos</a></li>
            @if (Auth::guest())
                <li class="dropdown">
                    <a class="login-trigger dropdown-toggle" data-toggle="dropdown"
                       role="button" aria-haspopup="true" aria-expanded="false" href="{{url('/login')}}">
                        Log in <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class=" nav-login  dropdown-menu animated  flipInX ">
                        @include('partials.forms._login')
                    </ul>
                </li>
                <li><a href="{{ url('/register') }}">Register</a></li>
            @else
                <li class='dropdown'>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                       role="button" aria-haspopup="true" aria-expanded="false" >
                        {!! cl_image_tag(Auth::user()->cloudinary_id,
                                ['width'=>20, 'height'=>20,'crop' => 'fill',
                                            'gravity' => 'face' ]) !!}
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu user-dropdown-menu" id="userMenuBadge">
                        <li class="text-center">
                            @if(Auth::user()->cloudinary_id)
                                {!! cl_image_tag(Auth::user()->cloudinary_id,
                                    ['width'=>80, 'height'=>80,'crop' => 'fill',
                                                'gravity' => 'face', 'radius'=>'max' ]) !!}
                            @else
                                <i class="fa fa-user fa-5x"></i>
                            @endif

                            <a href="{{ url(Auth::user()->username) }}">
                                <p>{{ Auth::user()->name }}</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/dashboard') }}"> <i class="fa fa-circle-o-notch"></i>Dashboard</a>
                        </li>
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
                    </ul>
                </li>
            @endif
        </ul>

    </div>
</nav>