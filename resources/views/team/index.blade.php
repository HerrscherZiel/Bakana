@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
              @if(Auth::user()->hasRole('Project Manager'))
              <a href="{{url('/teamprojects/create')}}" class="btn btn-primary mb-3">Create Team</a>
              @endif
            <thead>
              <tr>
{{--                <th>User</th>--}}
{{--                <th>Role</th>--}}
                <th>Project</th>
                  @if(Auth::user()->hasRole('Project Manager'))
                  <th>Action</th>
                      @endif
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach($team_projects as $teams)
{{--                <td>{{$teams->name}}</td>--}}
{{--                <td>{{$teams->nama_role}}</td>--}}
                <td>{{$teams->nama_project}}</td>
                      @if(Auth::user()->hasRole('Project Manager'))
                      <td>
                    <div class="btn-group">

                        <a href="/team/{{$teams->project_id}}" class="btn btn-primary">Show Team</a>


                        <a class="btn btn-info" href="/teamprojects/{{$teams->id_team_projects}}/edit">
                            <i class="fa fa-lg fa-edit">
                            </i>
                        </a>
                            <form class="delete" action="{{ route('teamprojects.destroy', $teams->id_team_projects)}}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit" style="margin-left: -2px">
                                <i class="fa fa-lg fa-trash">
                                </i>
                                </button>
                            </form>
                    </div>
                </td>
                    @endif
              </tr>
               @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
@endsection
