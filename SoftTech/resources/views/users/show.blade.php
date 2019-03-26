@extends('layout')

@section('title',"Desarrollador $user->id")

@section('content')
    <h1>Desarrollador #{{$user->id}}</h1>
    <p>Nombre del Desarrollador: {{$user->name}}</p>
    <p>Correo electrónico: {{$user->email}}</p>
    @if ($especialidad == null)
        <p>Especialidad: No tiene especialidad</p>
    @else
        <p>Especialidad: {{$especialidad->title}}</p>
    @endif
@endsection

