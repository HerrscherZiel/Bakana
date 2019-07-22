@extends('layouts.app')

@section('content')
<div class="col-md-12">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
    @endif
     <div class="tile">
        <h3 class="tile-title">Edit Team</h3>
        <form method="post" action="{{ route('teamprojects.update', $team_projects->id_team_projects) }}">
            @method('PATCH')
            @csrf
            <div class="tile-body">
                <div class="form-group">
                    <input type="hidden" value="{{csrf_token()}}" name="_token" />
                    <label class="control-label">Project</label>
                    <select class="form-control" name="project_id" required="">
                        @foreach($project as $projects)
                            <option value="{{$projects->id_project}}"
                                    @if ($projects->id === $team_projects->project_id)
                                    selected
                                @endif
                            >{{$projects->nama_project}}</option>
                        @endforeach
                    </select>
                </div>
                 <div class="form-group">
                    <label class="control-label">User</label>
                    <select class="form-control" name="user_id" required="">
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
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
              <a class="btn btn-secondary" href="{{URL::previous()}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
        </form>
      </div>
</div>
@endsection
