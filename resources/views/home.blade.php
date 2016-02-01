@extends('layouts.app')
@section('navbar')
    @include('partials.navbars._home_navbar_boostrap')
@endsection
@section('content')
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
