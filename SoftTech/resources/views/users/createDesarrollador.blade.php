@extends('layout')

@section('title', "Nuevo Desarrollador")


@section('content')
<div class="centrar" style="position :relative !important; left:25% !important; padding-bottom:20px;">
    <h1 style="padding-left:10%;">Nuevo Desarrollador</h1>
    <div class="my-10 p-3 bg-white rounded shadow-sm w-50">    
        <form method="POST" action="{{url('usuarios/crearDesarrollador')}}" enctype="multipart/form-data" >
            <!--{!! csrf_field() !!}-->
            <div class="form-group">
                <label for="name" class="col-form-label">Nombre:</label>
                    <input type="text" class="form-control form-control-sm" name="name" value="{{old('name')}}" >
                    @if ($errors->has('name'))
                    <span class="badge badge-danger">{{$errors->first('name')}}</span>
                    @endif
            </div>
            <div class="form-group">
                <label for="email" class="col-form-label">Correo electrónico:</label>
                    <input type="text" class="form-control form-control-sm" name="email" value="{{old('email')}}">
                    @if ($errors->has('email'))
                    <span class="badge badge-danger">{{$errors->first('email')}}</span>
                    @endif
            </div>
            <div class="form-group">
                <label for="password" class="col-form-label">Constraseña:</label>
                    <input type="password" class="form-control form-control-sm" name="password" >
                    @if ($errors->has('password'))
                    <span class="badge badge-danger">{{$errors->first('password')}}</span>
                    @endif
            </div>
            <div class="form-group">
                <label for="confirmacion" class="col-form-label">Confirma la constraseña:</label>
                    <input type="password" name="confirmacion" class="form-control form-control-sm">
                    @if ($errors->has('confirmacion'))
                    <span class="badge badge-danger">{{$errors->first('confirmacion')}}</span>
                    @endif
            </div>
            <div class="form-group">
                <label for="desc" class="col-form-label">Descripción: </label>
                    <textarea name="descripcion" class="form-control" rows="5" cols="30" placeholder="Maximo 100 caracteres" value="{{old('descripcion')}}"></textarea>
                    @if ($errors->has('descripcion'))
                    <span class="badge badge-danger">{{$errors->first('descripcion')}}</span>
                    @endif
            </div>
            <div class="form-group">
                <label for="especialidad" class="col-form-label">Especialidad: </label>
                    <select name="select" class="form-control">
                    <option disabled selected>Elige una especialidad</option>
                    @foreach($especialidades as $especialidad)
                    <option value="{{$especialidad->id}}">{{$especialidad->title}}</option>
                    @endforeach
                    </select>
            </div>
            <div class="form-group">
                <label for="uploadfile" class="col-form-label">Foto:</label>
                    <input name="uploadfile" class="form-control-file" type="file">
            </div>
            
                <button type="submit" class="btn btn-primary btn-lg btn-block">Crear usuario</button>
            
        </form>
    </div>
</div>
@endsection

