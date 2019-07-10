@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
                <a href="{{url('/modules/create')}}" class="btn btn-primary">Create Module</a>
            <tr>
                <td>ID</td>
                <td>Nama</td>
                <td>Waktu</td>
                <td>Status</td>
                <td>Project Name</td>
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
                    <td>{{$modules->nama_project}}</td>
                    <td>{{$modules->keterangan}}</td>
                   
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-info" href="/modules/{{$modules->id_module}}/edit">
                                <i class="fa fa-lg fa-edit">
                                </i>
                            </a>
                            <button class="btn btn-danger" >
                                <form action="{{ route('modules.destroy', $modules->id_module)}}" method="post">
                                @csrf
                                @method('DELETE')
                                    <i class="fa fa-lg fa-trash">
                                    </i>
                                </form>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
@endsection
