@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
                <a href="{{url('/modules/create')}}" class="btn btn-success pull-left">Create User</a>
            <tr>
                <td>ID</td>
                <td>Nama</td>
                <td>Waktu</td>
                <td>Status</td>
                <td>Keterangan</td>
                <td>Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($module as $modules)
                <tr>
                    <td>{{$modules->id_module}}</td>
                    <td>{{$modules->nama_module}}</td>
                    <td>{{$modules->waktu}}</td>
                    <td>{{$modules->status}}</td>
                    <td>{{$modules->keterangan}}</td>
                   

                    <td><a href="/modules/{{$modules->id_module}}/edit" class="btn btn-primary">Edit</a>

                    <form action="{{ route('modules.destroy', $modules->id_module)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
@endsection
