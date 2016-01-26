@extends('layouts.app')

@section('content')
    <table>
        <tr>
            <td colspan="2">
                {{HTML::image($user->avatar)}}
            </td>
        </tr>
        <tr>
            <td>Name</td>
            <td>{{$user->name}}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{$user->email}}</td>
        </tr>
        <tr>
            <td>Username</td>
            <td>{{$user->username}}</td>
        </tr>
        <tr>
            <td>Date Joined</td>
            <td>{{$dateFromNow}}</td>
        </tr>
        @if(Auth::check() && Auth::user()->username == $user->username)
        <tr>
            <td>{{link_to(url($user->username.'/edit'), 'Edit')}}</td>
        </tr>
        @endif
    </table>
@endsection