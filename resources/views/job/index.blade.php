@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
                <a href="{{url('/jobs/create')}}" class="btn btn-success pull-left">Create User</a>
            <tr>
                <td>ID</td>
                <td>Nama</td>
                <td>Modul</td>
                <td>Keterangan</td>
                <td>Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($job as $jobs)
                <tr>
                    <td>{{$jobs->id_job}}</td>
                    <td>{{$jobs->nama_job}}</td>
                    <td>{{$jobs->nama_module}}</td>
                    <td>{{$jobs->keterangan}}</td>
                   

                    <td><a href="/jobs/{{$jobs->id_job}}/edit" class="btn btn-primary">Edit</a>

                    <form action="{{ route('jobs.destroy', $jobs->id_job)}}" method="post">
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
