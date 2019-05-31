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
            <script type="text/javascript">
                notificacion({{sizeof($peticion)}});
            </script>
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
@section('links')
@parent
<style>
        .star{
          color: goldenrod;
          font-size: 2.0rem;
          padding: 0 1rem; /* space out the stars */
        }
        .star::before{
          content: '\2606';    /* star outline */
          cursor: pointer;
        }
        .star.rated::before{
          /* the style for a selected star */
          content: '\2605';  /* filled star */
        }
        
        .stars{
            counter-reset: rateme 0;   
            font-size: 2.0rem;
            font-weight: 900;
        }
        .star.rated{
            counter-increment: rateme 1;
        }
        .stars::after{
            content: counter(rateme) '/5';
        }
    </style>
@endsection

@section('content')
<!-- <img src="https://www.paypalobjects.com/webstatic/es_MX/mktg/logos-buttons/redesign/btn_13.png" alt="PayPal Credit" /> -->
<div class="d-flex align-items-center p-3 my-0 text-white-50 bg-info rounded shadow-sm">
    <div class="lh-100">
      <h2 class="mb-0 text-white lh-100">Bienvenido {{$user->name}}</h2>
    </div>
</div>
@if ($message = Session::get('success'))
  <script>
    toastr.success('{{$message}}');
  </script>
@endif
@for($i=sizeof($project)-1;$i>=0;$i--)
<div class="my-5 p-3 bg-white rounded shadow-sm" id="{{'project'.$i}}">
    <div class="border-bottom border-gray pb-2 mb-0">
      @if($project[$i]->entrega_final != null)
          <a class="btn btn-danger" href="#" onclick="javascript:finalizarProyecto({{$project[$i]->id}})"><i class="fas fa-radiation"></i><b> FINALIZAR PROYECTO</b></a><br><br>
      @endif
      <h5><b>{{$project[$i]->name}}</b>
      @if($project[$i]->costo == null)
        <a class="btn btn-success" href="#" onclick="javascript:subirPrecio({{$project[$i]->id}})"  data-toggle="tooltip" data-placement="top" title="Proponer Costo" style="position:absolute;right: 11%;"><i class="fas fa-money-bill-alt"></i></a>
      @else
      <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" style="
    width: 100px;
    position:absolute;
    right: 21%;
    top: 47.5%;">
      <input type="hidden" name="cmd" value="_s-xclick">
      <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
      <input type="image" src="https://www.paypalobjects.com/webstatic/es_MX/mktg/logos-buttons/redesign/btn_13.png" border="0" name="submit" alt="PayPal, la forma más segura y rápida de pagar en línea.">
      <img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
      </form>
        <a class="btn btn-success" data-toggle="tooltip" data-placement="top" title="{{'Costo: $'.$project[$i]->costo}}" style="position:absolute;right: 11%;"><i class="fas fa-money-bill-alt"></i></a>
      @endif
      <a class="btn btn-warning" href="#" onclick="javascript:subirReporte({{$project[$i]->id}},{{$project[$i]->cliente_id}})"  data-toggle="tooltip" data-placement="top" title="Reportar" style="position:absolute;right: 7%;"><i class="fas fa-exclamation-triangle"></i></a>
      </h5>
    @if($project[$i]->avance_1 == null)
      <a class="btn btn-danger" href="#" onclick="javascript:pedirAvance({{$project[$i]->id}})"  data-toggle="tooltip" data-placement="top" title="Sin fecha"><i class="fas fa-angle-double-right"></i> 1</a>
    @else
      @php
        $fecha = explode('-',$project[$i]->avance_1);
        $fechita=$fecha[2].'/'.$fecha[1].'/'.$fecha[0];
      @endphp
      @if($project[$i]->entrega_1 == null)
        <a class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Fecha: {{$fechita}}"><i class="fas fa-angle-double-right"></i> 1</a>
      @else
        <a class="btn btn-success" data-toggle="tooltip" href="#" data-placement="top" title="Evidencia Entregada" onclick="javascript:verAvance('{{$project[$i]->entrega_1}}','1')"><i class="fas fa-eye"></i> 1</a>   
      @endif
      @if($project[$i]->avance_2 == null)
        <a class="btn btn-danger" href="#" onclick="javascript:pedirAvance({{$project[$i]->id}})"  data-toggle="tooltip" data-placement="top" title="Sin fecha"><i class="fas fa-angle-double-right"></i> 2</a>
      @else
        @php
          $fecha = explode('-',$project[$i]->avance_2);
          $fechita=$fecha[2].'/'.$fecha[1].'/'.$fecha[0];
        @endphp
        @if($project[$i]->entrega_2 == null)
          <a class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Fecha: {{$fechita}}"><i class="fas fa-angle-double-right"></i> 2</a>
        @else
          <a class="btn btn-success" href="#" data-toggle="tooltip" data-placement="top" title="Evidencia Entregada" onclick="javascript:verAvance('{{$project[$i]->entrega_2}}','2')"><i class="fas fa-eye"></i> 2</a>   
        @endif
        @if($project[$i]->avance_final == null)
          <a class="btn btn-danger" href="#" onclick="javascript:pedirAvance({{$project[$i]->id}})"  data-toggle="tooltip" data-placement="top" title="Sin fecha">Final</a>
        @else
          @php
            $fecha = explode('-',$project[$i]->avance_final);
            $fechita=$fecha[2].'/'.$fecha[1].'/'.$fecha[0];
          @endphp
          @if($project[$i]->entrega_final == null)
            <a class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Fecha: {{$fechita}}">Final</a>
          @else
            <a class=" btn btn-success" href="{{asset('storage/evidencias/'.$project[$i]->entrega_final)}}" download data-toggle="tooltip" data-placement="top" title="Evidencia Entregada" >Final <i class="fas fa-download"></i></a>   
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
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>Elige una fecha</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('/crearAvance')}}" >
      <div class="modal-body">
          <div class="form-group" id="content">
                <input class="form-group date form-control" id="datepicker" type="text" name="date" autocomplete="off">
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="myMoney">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>Escribe la cantidad</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('/crearCosto')}}" >
      <div class="modal-body">
          <div class="form-group" id="contentMoney">
                <input class="form-group form-control" id="money" type="text" name="money" autocomplete="off" placeholder="$ MXN">
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="myEvidence">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b><span id="title"></span></b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="pdf"></div>
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
<div class="modal fade" tabindex="-1" role="dialog" id="myFinalizar">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>Califica el desempeño del desarrollador</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('/borrarProyecto')}}" >
      <div class="modal-body">
          <div class="form-group" id="contentBorrar">
            <input class="form-control" name="numero" type="hidden" value="" id="numero" min="0">
            <div class="stars" data-rating="3">
              <span class="star">&nbsp;</span>
              <span class="star">&nbsp;</span>
              <span class="star">&nbsp;</span>
              <span class="star">&nbsp;</span>
              <span class="star">&nbsp;</span>
          </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Seguir revisando</button>
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
function finalizarProyecto(id){
  $("#myFinalizar").modal('show');
  $( "#contentBorrar" ).append( " <input type='hidden' name='project_id' value='"+id+"' ><input type='hidden' name='quien' value='cliente' >" );
}

function pedirAvance(id){
  $("#myModal").modal('show');
  $( "#content" ).append( " <input type='hidden' name='project_id' value='"+id+"' >" );
}
function verAvance(titulo,numero){
  $("#myEvidence").modal('show');
  $( "#title" ).text("Evidencia "+numero);
  $("#pdf").html("<embed src='http://localhost:8000/storage/evidencias/"+titulo+"' width='770' height='400'>");
}
function subirReporte(id,reporto){
  $("#myReport").modal('show');
  $( "#contentReport" ).append( " <input type='hidden' name='project_id' value='"+id+"' ><input type='hidden' name='reporto' value='"+reporto+"' >" );
}
function subirPrecio(id){
  $("#myMoney").modal('show');
  $( "#contentMoney" ).append( " <input type='hidden' name='project_id' value='"+id+"' >" );
}
function notificacion(n){
  toastr.info('Tiene '+n+' notificaciones nuevas');
}
document.addEventListener('DOMContentLoaded', function(){
            let stars = document.querySelectorAll('.star');
            stars.forEach(function(star){
                star.addEventListener('click', setRating); 
            });
            
            let rating = parseInt(document.querySelector('.stars').getAttribute('data-rating'));
            let target = stars[rating - 1];
            target.dispatchEvent(new MouseEvent('click'));
        });
        function setRating(ev){
            let span = ev.currentTarget;
            let stars = document.querySelectorAll('.star');
            let match = false;
            let num = 0;
            stars.forEach(function(star, index){
                if(match){
                    star.classList.remove('rated');
                }else{
                    star.classList.add('rated');
                }
                //are we currently looking at the span that was clicked
                if(star === span){
                    match = true;
                    num = index + 1;
                }
            });
            document.querySelector('.stars').setAttribute('data-rating', num);
            $('#numero').val(num);
        }
</script>
@endsection