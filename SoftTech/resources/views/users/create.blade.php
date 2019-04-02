@extends('layout')

@section('title', "Nuevo Desarrollador")

@section('content')
    <h1>Nuevo Desarrollador</h1>

    <form method="POST" action="{{url('usuarios/crear')}}" >
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
        <button type="submit">Crear usuario</button>
    </form>
@endsection

