@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="row">
                <div class="col-md-10">
                    <h3>Project : {{$project->nama_project}}</h3>
                </div>
                @if(Auth::user()->hasRole('Project Manager'))
                <div class="col-md-2">
                <a href="/team/creates/{{$project->id_project}}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i>Add to Team</a>
             </div>
                    @endif
        </div>
        <div class="tile-body table-responsive">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th>User</th>
                <th>Role</th>
                  @if(Auth::user()->hasRole('Project Manager'))
                  <th style="width: 10%">Action</th>
                      @endif
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach($team_projects as $teams)
                <td>{{$teams->name}}</td>
                <td>{{$teams->nama_role}}</td>
                      @if(Auth::user()->hasRole('Project Manager'))
                      <td>
                    <div class="btn-group">
                        <a class="btn btn-info" href="/team/{{$teams->id_team_projects}}/edit">
                            <i class="fa fa-lg fa-edit">
                            </i>
                        </a>
                            <form class="delete" action="{{ route('teamprojects.destroy', $teams->id_team_projects)}}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger delete-btn" type="submit" style="margin-left: -2px">
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
