@extends('layout')

@section('title',"Cliente $user->name")
@section('navbar')
@parent
<div class="nav-scroller bg-white shadow-sm " style="margin-top:57px;">
      <nav class="nav nav-underline">
        <a class="nav-link disabled" href="#">Dashboard</a>
        <div class="dropdown">
            <a class="nav-link" href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Proyectos
            <span class="badge badge-pill bg-light align-text-bottom">{{sizeof($project)}}</span>
            </a>
            @if(sizeof($project)!=0)
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              @for($i=sizeof($project)-1; $i>=0; $i--)
                  <a class="dropdown-item" href="{{'#project'.$i}}">{{$project[$i]->name}}</a>
              @endfor
              </div>
            @endif
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
                  <a class="badge badge-danger" href="{{route('eliminar',$peticion[$i]->id)}}">ELIMINAR</a>
                  @else
                    El desarrollador rechazo tu proyecto:<br><b>{{$peticion[$i]->name}}</b><br>puedes intentar buscando otro desarrollador<br> 
                  <a class="badge badge-danger" href="{{route('eliminar',$peticion[$i]->id)}}">ELIMINAR</a>
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
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif
@for($i=sizeof($project)-1;$i>=0;$i--)
<div class="my-5 p-3 bg-white rounded shadow-sm" id="{{'project'.$i}}">
    <div class="border-bottom border-gray pb-2 mb-0"><h5><b>{{$project[$i]->name}}</b></h5>
    @if($project[$i]->avance_1 == null)
      <a class="fas fa-angle-double-right btn btn-danger" href="#" onclick="javascript:pedirAvance({{$project[$i]->id}})"  data-toggle="tooltip" data-placement="top" title="Sin fecha">1</a>
    @else
      @php
        $fecha = explode('-',$project[$i]->avance_1);
        $fechita=$fecha[2].'/'.$fecha[1].'/'.$fecha[0];
      @endphp
      @if($project[$i]->entrega_1 == 'N')
        <a class="fas fa-angle-double-right btn btn-danger" data-toggle="tooltip" data-placement="top" title="Fecha: {{$fechita}}">1</a>
      @else
        <a class="fas fa-angle-double-right btn btn-success" data-toggle="tooltip" data-placement="top" title="Fecha: {{$fechita}}">1</a>   
      @endif
      @if($project[$i]->avance_2 == null)
        <a class="fas fa-angle-double-right btn btn-danger" href="#" onclick="javascript:pedirAvance({{$project[$i]->id}})"  data-toggle="tooltip" data-placement="top" title="Sin fecha">2</a>
      @else
        @php
          $fecha = explode('-',$project[$i]->avance_2);
          $fechita=$fecha[2].'/'.$fecha[1].'/'.$fecha[0];
        @endphp
        @if($project[$i]->entrega_2 == 'N')
          <a class="fas fa-angle-double-right btn btn-danger" data-toggle="tooltip" data-placement="top" title="Fecha: {{$fechita}}">2</a>
        @else
          <a class="fas fa-angle-double-right btn btn-success" data-toggle="tooltip" data-placement="top" title="Fecha: {{$fechita}}">2</a>   
        @endif
        @if($project[$i]->avance_final == null)
          <a class="fas fa-angle-double-right btn btn-danger" href="#" onclick="javascript:pedirAvance({{$project[$i]->id}})"  data-toggle="tooltip" data-placement="top" title="Sin fecha">Final</a>
        @else
          @php
            $fecha = explode('-',$project[$i]->avance_final);
            $fechita=$fecha[2].'/'.$fecha[1].'/'.$fecha[0];
          @endphp
          @if($project[$i]->entrega_final == 'N')
            <a class="fas fa-angle-double-right btn btn-danger" data-toggle="tooltip" data-placement="top" title="Fecha: {{$fechita}}">Final</a>
          @else
            <a class="fas fa-angle-double-right btn btn-success" data-toggle="tooltip" data-placement="top" title="Fecha: {{$fechita}}">Final</a>   
          @endif
        @endif
      @endif
    @endif
    </div>
    <div class="media pt-3">
      <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
      <div class="scroll" style="width: 100%; max-height: 200px; overflow-y: scroll;display:block">
            @foreach($mensajes as $mensaje)
              @if($mensaje->project_id == $project[$i]->id)
                @if($mensaje->remitente == $user->id)
                <p class="badge badge-secondary" style="float:right;margin-right:10px;clear:both;padding:10px;font-size:small;">{{$mensaje->mensaje}}</p>
                @else
                <p class="badge badge-warning" style="float:left;margin-left:10px;clear:both;padding:10px;font-size:small;background-color:#ECECEC;">{{$mensaje->mensaje}}</p>
                @endif
              @endif
            @endforeach
      </div>
      </p>
    </div>
    <form method="POST" id="myForm" action="{{url('/sendMessage')}}" onsubmit="return validateMessage()">
    <div class="input-group mt-3 mb-3">
      <input autocomplete="off" id="text" name="text" type="text" class="form-control" placeholder="type a message..." aria-label="Type a message..." aria-describedby="enviarMensaje">
      <input id="project_id" name="project_id" type="hidden" value="{{$project[$i]->id}}">
      <input id="remitente" name="remitente" type="hidden" value="{{$project[$i]->cliente_id}}">
      <input id="destinatario" name="destinatario" type="hidden" value="{{$project[$i]->desarrollador_id}}">
      <div class="input-group-append">
        <button class="btn btn-success" type="submit" id="enviarMensaje">Enviar</button>
      </div>
    </form>
    </div>
  </div>
@endfor
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>Elige una fecha</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('crearAvance')}}" >
      <div class="modal-body">
          <div class="form-group" id="content">
                <input class="form-group date" id="datepicker" type="text" name="date" autocomplete="off">
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
function validateMessage() {
  var x = document.forms["myForm"]["text"].value;
  if (x == "") {
    alert("Debes escribir algo");
    return false;
  }
}
$( document ).ready(function() {
    var objDiv = document.getElementsByClassName("scroll");
    for(var i=0; i< objDiv.length; i++) {
     var trash = objDiv[i];
     trash.scrollTop = trash.scrollHeight;
  }
  $('#datepicker').datepicker({ dateFormat: 'dd/mm/yy' });
});
function pedirAvance(id){
  $("#myModal").modal('show');
  $( "#content" ).append( " <input type='hidden' name='project_id' value='"+id+"' >" );
}
</script>
@endsection