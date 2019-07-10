@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
                <a href="{{url('/projects/create')}}" class="btn btn-success pull-left">Create Project</a>
            <tr>
                <td>ID</td>
                <td>Kode Project</td>
                <td>Nama Project</td>
                <td>Tanggal Mulai</td>
                <td>Tanggal Selesai</td>
                <td>Status Project</td>
                <td>Keterangan</td>
                <td>Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($project as $projects)
                <tr>
                    <td>{{$projects->id_project}}</td>
                    <td>{{$projects->kode_project}}</td>
                    <td>{{$projects->nama_project}}</td>
                    <td>{{$projects->tgl_mulai}}</td>
                    <td>{{$projects->tgl_selesai}}</td>
                    <td>{{$projects->status}}</td>
                    <td>{{$projects->ket}}</td>

                    <td><a href="/projects/{{$projects->id_project}}" class="btn btn-success">Show</a>

                    <td><a href="/projects/{{$projects->id_project}}/edit" class="btn btn-primary">Edit</a>

                    <form action="{{ route('projects.destroy', $projects->id_project)}}" method="post">
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
