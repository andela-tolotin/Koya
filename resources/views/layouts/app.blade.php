<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Koya</title>
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">

</head>
<body id="app-layout">
    <nav>
        <div class="nav-wrapper">
            <!-- Branding Image -->
            <a class="brand-logo" href="{{ url('/') }}">Koya</a>
            <!-- Right Side Of Navbar -->
            <ul class="right hide-on-med-and-down">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
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
    <div class="container">
        @yield('content')
    </div>
    <!-- JavaScripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
    <script src="{!! URL::asset('js/modal.min.js') !!}"></script>
    <script src="{!! URL::asset('js/sweetalert.js') !!}"></script>
    <script type="text/javascript">
        $(".dropdown-button").dropdown();
    </script>
    @yield('custom-scripts')
</body>
</html>