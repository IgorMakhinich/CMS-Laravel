@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>

    {!! Form::model($post, ['method' => 'PATCH', 'route' => ['posts.update', $post->id]]) !!}
    <div class="form-group">
        {!! Form::label('title', 'New Title') !!}
        {!! Form::text('title', null, ['class' => 'form-control'] ) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Edit Post', ['class' => 'btn btn-info']) !!}
    </div>
    {!! Form::close() !!}
    {{--   <form method="post" action="/posts/{{$post->id}}">--}}
    {{--       <input type="hidden" name="_method" value="PUT">--}}
    {{--       <input type="text" name="title" placeholder="Enter title" value="{{$post->title}}">--}}
    {{--       <input type="submit" name="submit" value="UPDATE">--}}
    {{--       {{csrf_field()}}--}}
    {{--   </form>--}}


    {!! Form::open(['method' => "DELETE", 'route' => ['posts.destroy', $post->id]]) !!}
    <div class="form-group">
        {!! Form::submit('Delete Post', ['class' => 'btn btn-danger']) !!}
    </div>
    {!! Form::close() !!}

{{--    {!! Form::model($post, ['method' => 'DELETE', 'action' => ['App\Http\Controllers\PostsController@destroy', $post->id]]) !!}--}}
{{--    <div class="form-group">--}}
{{--        {!! Form::submit('Delete Post', ['class' => 'btn btn-danger']) !!}--}}
{{--    </div>--}}
{{--    {!! Form::close() !!}--}}
{{--    <form method="post" action="/posts/{{$post->id}}">--}}
{{--        <input type="hidden" name="_method" value="DELETE">--}}
{{--        <input type="submit" value="DELETE">--}}
{{--        {{csrf_field()}}--}}
{{--    </form>--}}

@endsection
