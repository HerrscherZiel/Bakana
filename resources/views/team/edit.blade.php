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
            <form method="post" action="{{ route('teams.update', $team_projects->id_team_projects) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="id_team_projects">ID:</label>
                    <input type="text" class="form-control" name="id_team_projects" value={{ $team_projects->id_team_projects }} />
                </div>
                <div class="form-group">
                    <label for="user_id">User ID:</label>
                    <input type="text" class="form-control" name="user_id" value={{ $team_projects->user_id }} />
                </div>
                <div class="form-group">
                    <label for="project_id">Project ID:</label>
                    <input type="text" class="form-control" name="project_id" value={{ $team_projects->project_id }} />
                </div>
                
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
