@extends('layout')

@section('title', "Nuevo Desarrollador")


@section('content')
    <h1>Nuevo Desarrollador</h1>

    <form method="POST" action="{{url('usuarios/crear')}}" enctype="multipart/form-data" >
        <!--{!! csrf_field() !!}-->

        <label for="name">Nombre:</label>
        <input type="text" name="name" value="{{old('name')}}" >
        @if ($errors->has('name'))
         <span class="badge badge-danger">{{$errors->first('name')}}</span>
        @endif
        <br>
        <label for="email">Correo electrónico:</label>
        <input type="text" name="email" value="{{old('email')}}">
        @if ($errors->has('email'))
         <span class="badge badge-danger">{{$errors->first('email')}}</span>
        @endif
        <br>
        <label for="password">Constraseña:</label>
        <input type="password" name="password" >
        @if ($errors->has('password'))
         <span class="badge badge-danger">{{$errors->first('password')}}</span>
        @endif
        <br>
        <label for="confirmacion">Confirma la constraseña:</label>
        <input type="password" name="confirmacion" >
        @if ($errors->has('confirmacion'))
         <span class="badge badge-danger">{{$errors->first('confirmacion')}}</span>
        @endif
        <br>
        <label for="desc">Descripción: </label>
        <textarea name="descripcion" rows="10" cols="30" placeholder="Maximo 100 caracteres" value="{{old('descripcion')}}"></textarea>
        @if ($errors->has('descripcion'))
         <span class="badge badge-danger">{{$errors->first('descripcion')}}</span>
        @endif
        <br>
        <label for="especialidad">Especialidad: </label>
        <select name="select">
            <option disabled selected>Elige una especialidad</option>
            @foreach($especialidades as $especialidad)
            <option value="{{$especialidad->id}}">{{$especialidad->title}}</option>
            @endforeach
        </select>
        <br>
        <label for="uploadfile">Foto:</label>
        <input name="uploadfile" type="file">
        <br>
        <button type="submit">Crear usuario</button>
    </form>
@endsection

