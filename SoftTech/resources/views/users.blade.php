@extends('layout')

@section('content')
    <h1>{{$title}}<h1>

        <ul>
             @foreach ($users as $user)
                 <li>{{$user->name}} , {{$user->email}}</li>
             @endforeach
        </ul>
@endsection

