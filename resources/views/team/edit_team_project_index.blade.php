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
            <form method="post" action="{{ route('teamprojects.update', $team_projects->id_team_projects) }}">
                @method('PATCH')
                @csrf

                <div class="form-group">
                    <label for="nama_project">Project:</label>
                    {{--                    <input type="text" class="form-control" name="id_module" value={{ $module->id_module }} />--}}
                    <select class="form-control" name="project_id">
                        <option value="" disabled>Select Project</option>
                        @foreach($project as $projects)
                            <option value="{{$projects->id_project}}"
                                    @if($projects->id_project !== $team_projects->project_id)
                                    disabled
                                @endif
                            >{{$projects->nama_project}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="user_id">User:</label>
                    <select name="user_id" id="" class="form-control" >
                        @foreach($user as $users)
                            <option value="{{$users->id}}"
                                    @if ($users->id !== $team_projects->user_id)
                                    selected
                                @endif
                            >
                                {{$users->name}}</option>
                        @endforeach
                    </select>
                </div>


        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <div>
@endsection
