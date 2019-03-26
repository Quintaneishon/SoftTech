@extends('layout')

@section('title','Desarrolladores')

@section('content')
    <h1>{{$title}}</h1>

        <ul>
             @foreach ($users as $user)
                 <li>{{$user->name}}
                    <a href="{{url("/usuarios/{$user->id}") }}">Ver detalles</a>
                 </li>

             @endforeach
        </ul>
@endsection

