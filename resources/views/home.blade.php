@extends('layouts.app')
@section('navbar')
    <link rel="stylesheet" href="{!! URL::asset('css/landing_page.css') !!}">

@endsection
@section('content')
    @include('partials.navbars._home_navbar_bootstrap')
@endsection

@section('custom-scripts')
    <script type="text/javascript">
        $(function() {
            $('.dropdown-toggle').dropdown();
            $('.dropdown input, .dropdown label').click(function(e) {
                e.stopPropagation();
            });
        });
    </script>
@endsection
