@extends('layouts.app')

@section('content')

<h1>Contact page</h1>

@if (count($users))
    <ul>
    @foreach ($users as $user)
        <li>{{$user}}</li>
    @endforeach
    </ul>
@endif
    
@endsection