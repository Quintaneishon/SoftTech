@extends('layout')

@section('title',"Desarrollador $user->id")

@section('dashboard')
<div class="nav-scroller bg-white shadow-sm" style="margin-top: 57px;">
      <nav class="nav nav-underline">
        <a class="nav-link active" href="#">Dashboard</a>
        <div class="dropdown">
            <a class="nav-link" href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Proyectos
            <span class="badge badge-pill bg-light align-text-bottom">2</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </div>
        <div class="dropdown">
            <a class="nav-link" href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell" id="bell"></i>
            <span class="badge badge-pill bg-light align-text-bottom">30</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </div>
  </nav>
</div>
@endsection

@section('content')
<div class="d-flex align-items-center p-3 my-0 text-white-50 bg-info rounded shadow-sm">
    <img class="mr-3" src="{{ asset('storage/fotukischidas/'.$user->foto) }}" alt="" width="70" height="70">
    <div class="lh-100">
      <h2 class="mb-0 text-white lh-100">Bienvenido {{$user->name}}</h2>
      <small>{{$especialidad->title}}</small>
    </div>
</div>

@endsection

@section ('links')
@parent
<style>
@keyframes rotate {from {transform: rotate(0deg);}
    to {transform: rotate(360deg);}}
@-webkit-keyframes rotate {from {-webkit-transform: rotate(0deg);}
  to {-webkit-transform: rotate(360deg);}}
#bell{
    -webkit-animation: 3s rotate linear infinite;
    animation: 3s rotate linear infinite;
    -webkit-transform-origin: 50% 50%;
    transform-origin: 50% 50%;
}
 {
     -webkit-animation-direction: reverse;
     animation-direction: reverse;
}
</style>
@endsection