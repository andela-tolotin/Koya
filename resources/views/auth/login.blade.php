@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col m8 offset-m2">
           @include('partials.forms._login')
        </div>
    </div>
</div>
@endsection