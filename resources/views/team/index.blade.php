@extends('layouts.app')

@section('content')

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

<div class="row">
    <div class="col-md-12">
      <div class="tile">
        @if(Auth::user()->hasRole('Project Manager'))
        <a href="{{url('/teamprojects/create')}}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i>Create Team</a>
        @endif
        <a href="{{url('/disbandedTeam')}}" class="btn btn-success mb-3"><i class="fa fa-flag"></i> Disbanded Team</a>
        <div class="tile-body table-responsive">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
{{--                <th>User</th>--}}
{{--                <th>Role</th>--}}
                <th>Project</th>

                  <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach($team_projects as $teams)
{{--                <td>{{$teams->name}}</td>--}}
{{--                <td>{{$teams->nama_role}}</td>--}}
                <td>{{$teams->nama_project}}</td>
                      <td>
                    <div class="btn-group">

                        <a href="/team/{{$teams->project_id}}" class="btn btn-primary">Show Team</a>
                        <a href="/team/experimental/{{$teams->project_id}}" class="btn btn-success">Experimental</a>
{{--                        <a onclick="showTeam();" href="#" class="btn btn-success" data-toggle="modal">Experimental</a>--}}
                        @if(Auth::user()->hasRole('Project Manager'))
                            <form class="delete" action="{{ route('teamprojects.destroy', $teams->id_team_projects)}}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger delete-btn" type="submit" style="margin-left: -2px">
                                <i class="fa fa-lg fa-trash">
                                </i>
                                </button>
                            </form>
                        @endif
                    </div>
                      </td>
              </tr>
               @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
@endsection
