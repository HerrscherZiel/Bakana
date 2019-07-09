@extends('layouts.app')

@section('content')
    <div class="container">
        @if(\Session::has('success'))
            <div class="alert alert-success">
                {{\Session::get('success')}}
            </div>
        @endif

        <div class="row">
            <a href="{{url('/projects/create')}}" class="btn btn-success">Create Project</a>
            <a href="{{url('/projects')}}" class="btn btn-default">All Project</a>
        </div>
    </div>
@endsection
