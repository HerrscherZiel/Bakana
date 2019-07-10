@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
                <a href="{{url('/users/create')}}" class="btn btn-success pull-left">Create User</a>
            <tr>
                <td>ID</td>
                <td>Nama</td>
                <td>Email</td>
                <td>Role</td>
                <td>Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($user as $users)
                <tr>
                    <td>{{$users->id}}</td>
                    <td>{{$users->name}}</td>
                    <td>{{$users->email}}</td>
                    <td>{{$users->nama_role}}</td>
                   

                    <td><a href="/users/{{$users->id}}/edit" class="btn btn-primary">Edit</a>

                    <form action="{{ route('users.destroy', $users->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
@endsection
