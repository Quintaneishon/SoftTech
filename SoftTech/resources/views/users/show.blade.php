@extends('layout')

@section('title',"Desarrollador $user->id")

@section('content')
<span class="clearfix"></span>
<div class="center-block">
<div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
          <div class="col-md-4">
            @if ($user->foto == null)
            <img src="{{asset('images/desarrollador.png')}}" class="card-img" alt="...">
            @else
            <img src="/storage/fotukischidas/{{$user->foto}}" class="card-img" alt="...">
            @endif
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title"><p><strong>Nombre del Desarrollador: </strong>{{$user->name}}</p></h5>
              <p class="card-text"><strong>Correo electrónico: </strong>{{$user->email}}</p>
                @if ($especialidad == null)
                <p class="card-text"><strong>Especialidad: </strong>No tiene especialidad</p>
                @else
                <p class="card-text"><strong>Especialidad: </strong>{{$especialidad->title}}</p>
                @endif
                @if ($user->descripcion == null)
                    <p class="card-text"><strong>Descripcion: </strong>No tiene descripcion</p>
                    @else
                    <p class="card-text"><strong>Descripcion: </strong>{{$user->descripcion}}</p>
                    @endif
                <p class="card-text"><strong>Calificacion: </strong>{{$user->calificacion}} <span class="fa fa-star checked"></span></p>
                <a href="#" class="btn btn-primary">Proponer Trato</a>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection

@section('links')
    @parent
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .checked {
      color: orange;
    }
</style>
@endsection
