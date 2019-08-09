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
                <div class="tile-body table-responsive">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th>Project</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($team_projects as $timesheets)
                            <tr>
                                <td>{{$timesheets->nama_project}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-info" href="/teamTimesheets/{{$timesheets->id_team_projects}}"><i class="fa fa-lg fa-eye">
                                            </i></a>
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
