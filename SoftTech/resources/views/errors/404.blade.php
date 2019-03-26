@extends('layout')

@section('title','404')

@section('content')
<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h1>4<span></span>4</h1>
        </div>
        <h2>Oops! Page Not Be Found</h2>
        <p>Sorry but the page you are looking for does not exist, have been removed. name changed or is temporarily unavailable</p>
    <a href="{{url('/')}}">Back to homepage</a>
    </div>
</div>
@endsection

@section('links')
    @parent

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,700" rel="stylesheet">

	<link type="text/css" rel="stylesheet" href="{{asset('css/404.css')}}" />
@endsection

