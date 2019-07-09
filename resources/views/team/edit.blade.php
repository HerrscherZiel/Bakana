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
                            <label for="user_id">User:</label>
                            <select name="user_id" id="" class="form-control" >
                                @foreach($user as $users)
                                    <option value="{{$users->id}}"
                                            @if ($users->id === $team_projects->user_id)
                                            selected
                                        @endif
                                    >
                                        {{$users->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="project_id">Project:</label>
                            <select name="project_id" id="" class="form-control" >
                                @foreach($project as $projects)
                                    <option value="{{$projects->id_project}}"
                                            @if ($projects->id === $team_projects->project_id)
                                            selected
                                        @endif
                                    >
                                        {{$projects->nama_project}}</option>
                                @endforeach
                            </select>
                        </div>
                
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
