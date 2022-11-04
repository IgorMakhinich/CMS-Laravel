@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
   <form method="post" action="/posts">
      <input type="text" name="title" placeholder="Enter title">
      <input type="hidden" name="_token" value="{!! csrf_token() !!}">
      <input type="submit" name="submit">
   </form>

@endsection
