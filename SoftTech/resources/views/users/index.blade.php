@extends('layout')

@section('title','Desarrolladores')

@section('content')
    <h1>{{$title}}</h1>

            <div class="row">
             @foreach ($users as $user)
                <div class="col-sm-3">
                  <div class="card h-100 d-inline-block border-info">
                    <div class="card-header"><h5 class="card-title">{{$user->name}}</h5></div>
                    <div class="card-body">
                      @if ($user->descripcion == null)
                        <p class="card-text"><strong>Especialidad: </strong> No tiene</p>
                      @else
                      <p class="card-text"><strong>Especialidad: </strong>{{$especialidades->find($user->especialidad_id)->title}}</p>
                      @endif
                      <p class="card-text"><strong>Calificación: </strong>{{$user->calificacion}} <span class="fa fa-star checked"></span></p>
                      <a href="{{url("/usuarios/{$user->id}") }}" class="btn btn-primary">Ver detalles</a>
                    </div>
                  </div>
                </div>
             @endforeach
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
