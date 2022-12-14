@extends('layouts.app')
@section('title')
    Details
@endsection
@section('content')

    <div class="col-sm-6 col-md-9 col-lg-9">
    <div class="card card-primary">

                 <div class="card-header">
                    <h3 class="card-title">{{$title}}-Form
                        <a href="{{route($route .'index')}}" class="btn btn-success">List</a>
{{--                        <a href="{{route('comment.create')}}" class="btn btn-success">Comment</a>--}}

                    </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {!! Form::open(['route' => $route .'store' , 'method' => 'post' , 'class' => 'form-horizontal']) !!}
        @csrf

                <div class="card-body">
                    <div class="form-group row">
                        {!! Form::label('title', 'Title: <span class="required">*</span>',['class' => 'col-sm-2 col-form-label'],false); !!}
                        <br>
                        <div class="col-sm-10">
                            {!! Form::text('title', '', [ 'class'=>'form-control', 'placeholder'=>'Enter title']); !!}
                            @error('title')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group row">
                        {!! Form::label('description', 'Description: <span class="required">*</span>',['class' => 'col-sm-2 col-form-label'],false); !!}
                        <br>
                        <div class="col-sm-10">
                            {!! Form::text('description', '', [ 'class'=>'form-control', 'placeholder'=>'Enter description']); !!}
                            @error('description')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group row">
                        {!! Form::label('post_id','Post: <span class="required">*</span>',['class' => 'col-sm-2 col-form-label'],false); !!}

                        <div class="col-sm-10">
                            {!! Form::text('post_id', '', [ 'class'=>'form-control', 'placeholder'=>'Enter description']); !!}
                            @error('post_id')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
{{--        </form>--}}
    </div>
    </div>
@endsection

@section('csss')
    <style>
        .required{
            color: red;
        }
    </style>
@endsection

