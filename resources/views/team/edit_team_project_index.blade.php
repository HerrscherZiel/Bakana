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

         <select class="form-control" name="tittle" required="" style="display: none">
         @foreach($project as $projects)

                 <option value="{{$projects->id_project}}"
                         @if($projects->id_project === $team_projects->project_id)
                         selected {{$tittle = $projects->nama_project}}
                     @endif
                 >{{$projects->nama_project}}</option>
             @endforeach
         </select>


        <h3 class="tile-title">Project {{$tittle}}</h3>
        <form method="post" action="{{ route('teamprojects.update', $team_projects->id_team_projects) }}">
            @method('PATCH')
            @csrf
            <div class="tile-body">
                <div class="form-group">
                    <input type="hidden" value="{{csrf_token()}}" name="_token" />
                    <select class="form-control" name="project_id" required="" style="display: none">
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
                    <label class="control-label">User</label>
                    <select class="form-control" name="user_id" required="">
                        @foreach($user as $users)
                            <option value="{{$users->id}}"
                                    @if ($users->id === $team_projects->user_id)
                                    selected
                                @endif
                            >{{$users->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
              <a class="btn btn-secondary" href="javascript:history.go(-1)"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
        </form>
      </div>
</div> 
@endsection
