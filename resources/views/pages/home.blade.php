@extends('layout')

@section('content')
    <div class="jumbotron">
        <h1>Theme example</h1>

        <p>This is a template showcasing the optional theme stylesheet included in Bootstrap. Use it as a starting point
            to create something more unique by building on or modifying it.
        </p>

        @if($signedIn)
            <a href="/flyers/create" class="btn btn-primary">Create A Flyer</a>
        @else
            <a href="/register" class="btn btn-primary">Sign Up</a>
        @endif
    </div>

@stop