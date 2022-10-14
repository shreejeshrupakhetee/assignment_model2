@extends('layouts.app')
@section('title')
    Home
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" >
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body" >

                    <div class="buttons">
                    <a href="{{route('post.index')}}" class="btn btn-success">Post</a>
                    <a href="{{route('user.index')}}" class="btn btn-success">User</a>
                    <a href="{{route('details.create')}}" class="btn btn-success">Details</a>
                    <a href="{{route('post.create')}}" class="btn btn-success">Postss</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('csss')
<style>
    .buttons {
        text-align:justify;
    }
    .buttons:after {
        content:'';
        display:inline-block;
        width:99.5%;/* generates an extra transparent line */
    }
    /* makeup*/
    .buttons {
        min-width:45em;
        padding: 1.2em 1em 0;
        margin:1em;

    }
</style>
@endsection
