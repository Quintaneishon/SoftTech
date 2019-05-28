@extends('layout')

@section('title',"Desarrollador $user->name")
@section('navbar')
<div class="nav-scroller fixed-top " style="background-color:#D0D6DA;">
      <nav class="nav nav-underline">
        <a class="navbar-brand" href="{{url("/usuarios")}}"><img src="{{asset('images/logoTrans.png')}}" width="109px" height="23px"></a>
        <a class="nav-link active" href="#">Dashboard</a>
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
            <script type="text/javascript">
                notificacion({{sizeof($peticion)}});
            </script>
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
            <button id="btnGroupDrop2" type="button" class="btn btn-outline-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left:1300%;">
            <i class="fas fa-bars"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
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
      <h2 class="mb-0 text-white lh-100">Bienvenido <span id="userName">{{$user->name}}</span></h2>
      <small>{{$especialidad->title}}</small>
    </div>
</div>
@if ($message = Session::get('success'))
  <script>
    toastr.success('{{$message}}');
  </script>
@endif
@for($i=sizeof($project)-1;$i>=0;$i--)
<div class="my-5 p-3 bg-white rounded shadow-sm" id="{{'project'.$i}}">
    <div class="border-bottom border-gray pb-2 mb-0"><h5><b>{{$project[$i]->name}}</b><a class="btn btn-warning" href="#" onclick="javascript:subirReporte({{$project[$i]->id}},{{$project[$i]->desarrollador_id}})"  data-toggle="tooltip" data-placement="top" title="Reportar" style="margin-left: 88%;"><i class="fas fa-exclamation-triangle"></i></a></h5>
      @if($project[$i]->avance_1 != null)
        @if($project[$i]->entrega_1 == null)
        @php
        $fecha = explode('-',$project[$i]->avance_1);
        $fechita=$fecha[2].'/'.$fecha[1].'/'.$fecha[0];
        @endphp
          <a class="btn btn-danger" href="#" onclick="javascript:subirAvance({{$project[$i]->id}},'')"  data-toggle="tooltip" data-placement="top" title="Fecha: {{$fechita}}"><i class="fas fa-upload"></i> 1</a>
        @else
          <a class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Evidencia Entregada"><i class="fas fa-check"></i> 1</a>
        @endif
        @if($project[$i]->avance_2 != null)
          @if($project[$i]->entrega_2 == null)
          @php
          $fecha = explode('-',$project[$i]->avance_1);
          $fechita=$fecha[2].'/'.$fecha[1].'/'.$fecha[0];
          @endphp
            <a class="btn btn-danger" href="#" onclick="javascript:subirAvance({{$project[$i]->id}},'')"  data-toggle="tooltip" data-placement="top" title="Fecha: {{$fechita}}"><i class="fas fa-upload"></i> 2</a>
          @else
            <a class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Evidencia Entregada"><i class="fas fa-check"></i> 2</a>
          @endif
          @if($project[$i]->avance_final != null)
          @php
          $fecha = explode('-',$project[$i]->avance_1);
          $fechita=$fecha[2].'/'.$fecha[1].'/'.$fecha[0];
          @endphp
            @if($project[$i]->entrega_final == null)
              <a class="btn btn-danger" href="#" onclick="javascript:subirAvance({{$project[$i]->id}},'f')"  data-toggle="tooltip" data-placement="top" title="Fecha: {{$fechita}}"><i class="fas fa-upload"></i> Final</a>
            @else
              <a class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Evidencia Entregada"><i class="fas fa-check"></i> Final</a>
            @endif
          @endif
        @endif
      @endif
    </div>
    <div class="media text-muted pt-3">
      <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
      <div class="scroll" style="width: 100%; max-height: 200px; overflow-y: scroll;" onload="scrollToBottom()">
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
    <form method="POST" id="myForm" action="{{url('/sendMessage')}}" onsubmit="return validateMessage()" >
    <div class="input-group mt-3 mb-3">
    <input autocomplete="off" id="text" name="text" type="text" class="form-control" placeholder="type a message..." aria-label="Type a message..." aria-describedby="enviarMensaje">
      <input id="project_id" name="project_id" type="hidden" value="{{$project[$i]->id}}">
      <input id="remitente" name="remitente" type="hidden" value="{{$project[$i]->desarrollador_id}}">
      <input id="destinatario" name="destinatario" type="hidden" value="{{$project[$i]->cliente_id}}">
      <div class="input-group-append">
        <button class="btn btn-success" type="submit" id="enviarMensaje">Enviar</button>
      </div>
    </form>
    </div>
  </div>
  <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>Sube tu evidencia</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('/crearEvidencia')}}" enctype="multipart/form-data" onsubmit="return validateEvidencia()">
      <div class="modal-body">
          <div class="form-group" id="content">
            <input name="uploadfile" class="form-control-file" type="file" id="file">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="myReport">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>Reportar Desarrollador</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('/crearReporte')}}" >
      <div class="modal-body">
          <div class="form-group" id="contentReport">
          <textarea name="reporte" class="form-control" rows="5" cols="30" placeholder="Cuentanos que paso"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endfor

@endsection

@section('scripts')
<script>
function validateMessage() {
  var x = $('#text').val();
  if (x == "") {
    alert("Debes escribir algo");
    return false;
  }
}
function validateEvidencia() {
  var x = $('#file').val();
  var array = x.split(".");
  var tipo = $('#tipo').val();
  if (x == "") {
    alert("Debes subir algo");
    return false;
  }
  if(tipo=='f'){
    if(array[1] != "zip" && array[1] != "rar"){
      alert("El archivo final tiene que ser extension zip o rar");
      return false;
    }
  }else{
    if(array[1] != "pdf" ){
      alert("El archivo debe ser pdf");
      return false;
    }
  }
}
$( document ).ready(function() {
    var objDiv = document.getElementsByClassName("scroll");
    console.log(objDiv.length);
    for(var i=0; i< objDiv.length; i++) {
     var trash = objDiv[i];
     trash.scrollTop = trash.scrollHeight;
  } 
});
function subirAvance(id,final){
  $("#myModal").modal('show');
  $( "#content" ).append( " <input type='hidden' name='project_id' value='"+id+"' ><input type='hidden' id='tipo' value='"+final+"' >" );
}
function subirReporte(id,reporto){
  $("#myReport").modal('show');
  $( "#contentReport" ).append( " <input type='hidden' name='project_id' value='"+id+"' ><input type='hidden' name='reporto' value='"+reporto+"' >" );
}
function notificacion(n){
  toastr.info('Tiene '+n+' notificaciones nuevas');
}
</script>
@endsection