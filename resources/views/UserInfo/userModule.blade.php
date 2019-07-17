@extends('layouts.app')

@section('content')

    @foreach($modulpro as $mod)
    <div>
        {{$mod->nama_project}}
        {{$mod->nama_module}}
    </div>
    @endforeach

@endsection
