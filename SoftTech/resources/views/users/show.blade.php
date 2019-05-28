@extends('layout')

@section('title',"Desarrollador $user->id")

@section('content')
<br><br><br>
<div  style="display: flex;justify-content: center; align-items: center">
<div class="card mb-3" style="max-width: 640px;">
@if ($message = Session::get('success'))
  <script>
    toastr.success('{{$message}}');
  </script>
@endif
        <div class="row no-gutters">
          <div class="col-md-4">
            @if ($user->foto == null)
            <img src="{{asset('images/desarrollador.png')}}" height="100%" width="100%" class="card-img" alt="...">
            @else
            <img src="{{ asset('storage/fotukischidas/'.$user->foto) }}" height="100%" width="100%"  class="card-img" alt="...">
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
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Proponer Trato</a>
            </div>
          </div>
        </div>
      </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>Escribe una rápida descripción de tu proyecto para que al desarrollador le interese</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('usuarios/crearTrato')}}" >
      <div class="modal-body">
          <h6>Nombre de tu proyecto</h6>
          <div class="form-group">
            <input type="text" class="form-control" id="titleProyect" name="titleProyect" autocomplete="off">
          </div>
          <h6>Resumen</h6>
          <div class="form-group">
            <textarea name="resumen" class="form-control" rows="5" cols="30" ></textarea>
          </div>
          <input type="hidden" id="desarrolladorID" name="desarrolladorID" value="{{$user->id}}">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
      </form>
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
