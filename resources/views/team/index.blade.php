@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <a href="{{url('/teamprojects/create')}}" class="btn btn-primary mb-3">Create Team</a>
            <thead>
              <tr>
                <th>User</th>
                <th>Role</th>
                <th>Project</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach($team_projects as $teams)
                <td>{{$teams->name}}</td>
                <td>{{$teams->nama_role}}</td>
                <td>{{$teams->nama_project}}</td>
                <td>
                    <div class="btn-group">
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
              </tr>
               @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
@endsection
