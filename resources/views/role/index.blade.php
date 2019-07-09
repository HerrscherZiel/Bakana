@extends('layouts.app')

@section('content')
    <div class="container">
        <div><a href="{{url('/roles/create')}}" class="btn btn-success">Create Role</a></div>
        <table class="table table-striped">
            <thead>
            <tr>
                <td>ID</td>
                <td>Nama Role</td>
                <td>Keterangan</td>
                <td>Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($role as $roles)
                <tr>
                    <td>{{$roles->id_role}}</td>
                    <td>{{$roles->nama_role}}</td>
                    <td>{{$roles->keterangan}}</td>
                    <td><a href="/projects/{{$roles->id_role}}/edit" class="btn btn-primary">Edit</a>
                        <form action="{{ route('roles.destroy', $roles->id_role)}}" method="post">
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
