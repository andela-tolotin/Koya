<div class="navbar-fixed tech-nav ">
    <nav class='tech-nav-container'>
        <ul class="nav-wrapper container">
            <!-- Branding Image -->
            <a class="brand-logo" href="{{ url('/') }}">
                <img src="{{URL::asset('images/logo.png')}}"/>
            </a>
            <!-- Right Side Of Navbar -->
            <ul class="right hide-on-med-and-down">
                <!-- Authentication Links -->
                <li><a href="#" >Categories</a></li>

                @if (Auth::guest())
                    <li><a class="dropdown-button" href="#!" data-activates="dropdown" data-beloworigin="true">Login
                            <i class="mdi-navigation-arrow-drop-down right"></i>
                        </a>
                    </li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li>
                        <a data-activates="userMenuBadge" href="#" class="dropdown-button">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-content" id="userMenuBadge">
                            <li>
                                <a href="{{ url('/dashboard') }}"> <i class="fa fa-circle-o-notch"></i>Dashboard</a>
                            </li>
                            <li>
                                <a href="{{ url(Auth::user()->username) }}">
                                    <i class="fa fa-qrcode"></i> Profile
                                </a>
                            </li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</div>
<div id="hero">
    <div class="bg-img"></div>
    <div class="overlay"></div>
    <div class="hero-content">
        <h1>Share contents and knowledge</h1>
        <h4>Upload a youtube video link and share with other techies</h4>
    </div>
</div>

<ul id="dropdown" class="dropdown-content login">
    {{Form::open(['url'=>'/login', 'id'=>'loginBox'])}}
        <li>
            <input type="text" placeholder="Your email address"/>
        </li>
        <li>
            <input type="password" placeholder="Password"/>
        </li>
    {{Form::close()}}
</ul>
