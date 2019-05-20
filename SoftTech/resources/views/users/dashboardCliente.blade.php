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

@for($i=sizeof($project)-1;$i>=0;$i--)
<div class="my-5 p-3 bg-white rounded shadow-sm" id="{{'project'.$i}}">
    <h5 class="border-bottom border-gray pb-2 mb-0"><b>{{$project[$i]->name}}</b></h5>
    <div class="media pt-3">
      <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
      <div class="scroll" style="width: 100%; max-height: 200px; overflow-y: scroll;display:block">
            @foreach($mensajes as $mensaje)
              @if($mensaje->project_id == $project[$i]->id)
                @if($mensaje->remitente == $user->id)
                <p class="badge badge-warning" style="float:right;margin-right:10px;clear:both;padding:10px;font-size:small;background-color:#ECECEC;">{{$mensaje->mensaje}}</p>
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
    console.log(objDiv.length);
    for(var i=0; i< objDiv.length; i++) {
     var trash = objDiv[i];
     trash.scrollTop = trash.scrollHeight;
  } 
});
</script>
@endsection