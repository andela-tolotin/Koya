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
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,100,300,700,500' rel='stylesheet' type='text/css'>
    <!-- Styles -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <link rel="stylesheet" href="{!! asset('css/sweetalert.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/bootstrap-social.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/animate.css') !!}">
    @yield('custom-style')
</head>
<body id="app-layout">
    @yield('navbar')
    @yield('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="{!! asset('js/modal.min.js') !!}"></script>
    <script src="{!! asset('js/sweetalert.min.js') !!}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    @yield('custom-scripts')
    @include('partials._errors')
    {{--<script type="text/javascript">--}}
        {{--$(".dropdown-button").dropdown();--}}

        {{--changeNavbarStyle();--}}
        {{--$(document).scroll(function(e){--}}
            {{--changeNavbarStyle();--}}
        {{--});--}}
        {{--function changeNavbarStyle(){--}}
            {{--if($(this).scrollTop() > 80) {--}}
                {{--console.log($(this).scrollTop());--}}
                {{--$('.tech-nav-container').addClass('tech-nav-scroll');--}}
            {{--} else {--}}
                {{--$('.tech-nav-container').removeClass('tech-nav-scroll');--}}
            {{--}--}}
        {{--}--}}
    {{--</script>--}}
  </body>
</html>