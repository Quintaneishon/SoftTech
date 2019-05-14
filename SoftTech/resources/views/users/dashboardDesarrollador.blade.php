@extends('layout')

@section('title',"Desarrollador $user->id")
@section('navbar')
<div class="nav-scroller fixed-top " style="background-color:#D0D6DA;">
      <nav class="nav nav-underline">
        <a class="navbar-brand" href="{{url("/usuarios")}}"><img src="{{asset('images/logoTrans.png')}}" width="109px" height="23px"></a>
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
            @if(sizeof($peticion)==0)
            <i class="fa fa-bell" id="bell"></i>
            @else
            <i class="fa fa-bell faa-ring animated" id="bell"></i>
            @endif
            <span class="badge badge-pill bg-light align-text-bottom">{{sizeof($peticion)}}</span>
            </a>
            @if(sizeof($peticion)!=0)
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @for($i=sizeof($peticion)-1;$i>=0;$i--)
                <div class="dropdown-item border">
                  <b>{{$peticion[$i]->name}}</b><br>
                  {{$peticion[$i]->resumen}}<br>
                  <a class="badge badge-success" href="{{route('contestar',['opcion'=>'aceptar','id'=>$peticion[$i]->id])}}">Aceptar</a>
                  <a class="badge badge-danger" href="{{route('contestar',['opcion'=>'rechazar','id'=>$peticion[$i]->id])}}">Rechazar</a>
                </div>
                @endfor
            </div>
            @endif
        </div>
        <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-outline-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left:1500%;">
            <i class="fas fa-bars"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
            <a class="dropdown-item" href="/logout">Log Out</a>
            <a class="dropdown-item" href="#">Ayuda</a>
            </div>
          </div>
  </nav>
</div>
@endsection

@section('content')
<div class="d-flex align-items-center p-3 my-0 text-white-50 bg-info rounded shadow-sm">
    @if ($user->foto != null)
    <img class="mr-3" src="{{ asset('storage/fotukischidas/'.$user->foto) }}" alt="" width="70" height="70">
    @else
    <img src="{{asset('images/desarrollador.png')}}" height="70" width="70" class="mr-3" alt="...">
    @endif
    <div class="lh-100">
      <h2 class="mb-0 text-white lh-100">Bienvenido {{$user->name}}</h2>
      <small>{{$especialidad->title}}</small>
    </div>
</div>

<div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">Proyecto 1</h6>
    <div class="media text-muted pt-3">
      <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <strong class="d-block text-gray-dark">@username</strong>
        Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
      </p>
    </div>
    <small class="d-block text-right mt-3">
      <a href="#">All updates</a>
    </small>
  </div>

@endsection