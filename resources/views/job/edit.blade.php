@extends('layouts.app')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Edit User
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post" action="{{ route('jobs.update', $job->id_job) }}">
                @method('PATCH')
                @csrf
                {{--<div class="form-group">
                    <label for="id_job">ID:</label>
                    <input type="text" class="form-control" name="id_job" value={{ $job->id_job }} />
                </div>--}}
                <div class="form-group">
                    <label for="nama_job">Nama:</label>
                    <input type="text" class="form-control" name="nama_job" value={{ $job->nama_job }} />
                </div>
                <div class="form-group">
                    <label for="user">User:</label>
                    <select class="form-control" name="user">
                        {{--<option value="{{$job->user}}" selected>{{$job->user}}</option>--}}
                        @foreach($user as $users)
                            <option value="{{$users->name}}">{{$users->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="module_id">Modul:</label>
                    <select class="form-control" name="module_id">
                        <option value="">Select Project</option>
                        @foreach($module as $modules)
                            <option value="{{$modules->id_module}}"
                                    @if($modules->id_module === $job->module_id)
                                    selected
                                    @endif
                            >{{$modules->nama_module}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <input type="text" class="form-control" name="keterangan" value={{ $job->keterangan }} />
                </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
