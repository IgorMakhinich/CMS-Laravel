@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>

    @if(count($errors) > 0)

        <div class="alert alert-danger">

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>

    @endif

    {!! Form::open(['method' => 'POST', 'action' => 'App\Http\Controllers\PostsController@store']) !!}
    <div class="form-group">
        {!! Form::label('title', 'Title') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Create Post', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
    {{--   <form method="post" action="/posts">--}}
    {{--    <input type="text" name="title" placeholder="Enter title">--}}
    {{--    <input type="hidden" name="_token" value="{!! csrf_token() !!}">--}}
    {{--      <input type="submit" name="submit">--}}
    {{--   </form>--}}
@endsection
