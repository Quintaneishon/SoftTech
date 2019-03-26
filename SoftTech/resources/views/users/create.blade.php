@extends('layout')

@section('title', "Crear usuario")

@section('content')
    <h1>Crear Usuario</h1>
    @if ($errors->any())
        errores
    @endif

    <form method="POST" action="{{url('usuarios/crear')}}" >
        <!--{!! csrf_field() !!}-->

        <label for="name">Nombre:</label>
        <input type="text" name="name">
        @if ($errors->has('name'))
            <p>{{$errors->first('name')}}</p>
        @endif
        <br>
        <label for="email">Correo electrónico:</label>
    <input type="text" name="email" value="{{old('email')}}">
        <br>
        <label for="password">Constraseña:</label>
        <input type="password" name="password" >
        <br>
        <button type="submit">Crear usuario</button>
    </form>
@endsection

