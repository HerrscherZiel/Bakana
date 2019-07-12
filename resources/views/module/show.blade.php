@extends('layouts.app')

@section('content')
<div class="card uper">
    <div class="card-header">
        {{--<h4>{{$ko}}</h4>--}}
        <a href="/jobs/creates/{{$mod->id_module}}" class="btn btn-primary pull-right">Add Job</a>
        <br>

    </div>
    <div class="card-body">
        @foreach($module as $modules)
        <h6>Nama = {{$modules->nama_module}}</h6>
        <h6>Waktu = {{$modules->waktu}}</h6>
        <h6>Status = {{$modules->status}}</h6>
        <h6>Project = {{$modules->nama_project}}</h6>
        <h6>Keterangan = {{$modules->keterangan}}</h6>

        <small>Written On {{$modules->created_at}}</small>
        @endforeach

    </div>


    <table class="table table-striped">
        <thead>
        <tr>
            <td>Nama</td>
            <td>User</td>
            <td>Module</td>
            <td>Keterangan</td>
            <td>Action</td>
        </tr>
        </thead>
        <tbody>
        @foreach($job as $jobs)

        <tr>
            <td>{{$jobs->nama_job}}</td>
            <td>{{$jobs->user}}</td>
            <td>{{$jobs->nama_module}}</td>
            <td>{{$jobs->keterangan}}</td>

            <td>
                <div class="btn-group">
                    <a class="btn btn-info" href="/jobs/{{$jobs->id_job}}/edit">
                        <i class="fa fa-lg fa-edit">
                        </i>
                    </a>

                    <form action="{{ route('jobs.destroy', $jobs->id_job)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">
                            <i class="fa fa-lg fa-trash">
                            </i>
                        </button>

                    </form>

                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>


</div>

@endsection
