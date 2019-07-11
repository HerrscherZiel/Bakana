@extends('layouts.app2')

@section('content')
    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}
                <H2>Unauthorized Action</H2>
                <a href="{{url('/home')}}" class="btn btn-default">Redirect to Home</a>
            </div>
        @endif

        <div class="row">
            <a href="{{url('/projects/create')}}" class="btn btn-success">Create Project</a>
            <a href="{{url('/projects')}}" class="btn btn-default">All Project</a>
        </div>
    </div>
@endsection
