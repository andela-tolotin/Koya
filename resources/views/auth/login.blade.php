@extends('layouts.app')
@section('custom-style')
    <link rel="stylesheet" href="{!! secure_asset('css/registration.css') !!}">
@endsection

@section('navbar')
    @include('partials.navbars._navbar')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-4 col-xs-12 col-md-offset-4">
           @include('partials.forms._login')
        </div>
    </div>
</div>
@endsection