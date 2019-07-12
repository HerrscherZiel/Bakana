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
            <form method="post" action="{{ route('modules.update', $module->id_module) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="nama_project">Project:</label>
{{--                    <input type="text" class="form-control" name="id_module" value={{ $module->id_module }} />--}}
                    <select class="form-control" name="project_id">
                        <option value="" disabled>Select Project</option>
                        @foreach($project as $projects)
                            <option value="{{$projects->id_project}}"
                                    @if($projects->id_project !== $module->project_id)
                                         disabled
                                    @endif
                            >{{$projects->nama_project}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label for="nama_module">Nama:</label>
                    <input type="text" class="form-control" name="nama_module" value={{ $module->nama_module }} />
                </div>
                <div class="form-group">
                    <label for="waktu">Waktu:</label>
                    <input type="text" class="form-control" name="waktu" value={{ $module->waktu }} />
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <input type="text" class="form-control" name="status" value={{ $module->status }} />
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <input type="text" class="form-control" name="keterangan" value={{ $module->keterangan }} />
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
