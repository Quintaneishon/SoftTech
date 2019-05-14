@extends('layout')

@section('title',"Cliente $user->id")
@section('navbar')
@parent
<div class="nav-scroller bg-white shadow-sm " style="margin-top:57px;">
      <nav class="nav nav-underline">
        <a class="nav-link disabled" href="#">Dashboard</a>
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
                @for($i=sizeof($peticion)-1; $i>=0; $i--)
                <div class="dropdown-item border">
                  @if($peticion[$i]->aceptado == 'S')
                    El desarrollador aceptó tu proyecto:<br><b>{{$peticion[$i]->name}}</b><br> comunicate con el para más detalles <br> 
                  <a class="badge badge-success" href="#">GO</a>
                  <a class="badge badge-danger" href="{{route('eliminar',$peticion[$i]->id)}}">OK</a>
                  @else
                    El desarrollador rechazo tu proyecto:<br><b>{{$peticion[$i]->name}}</b><br>puedes intentar buscando otro desarrollador<br> 
                  <a class="badge badge-danger" href="{{route('eliminar',$peticion[$i]->id)}}">OK</a>
                  @endif
                </div>
                @endfor
            </div>
            @endif
        </div>
  </nav>
</div>
@endsection

@section('content')
<div class="d-flex align-items-center p-3 my-0 text-white-50 bg-info rounded shadow-sm">
    <div class="lh-100">
      <h2 class="mb-0 text-white lh-100">Bienvenido {{$user->name}}</h2>
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