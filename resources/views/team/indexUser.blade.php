@extends('layouts.user')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th>User</th>
                            <th>Role</th>
                            <th>Project</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($team_projects as $teams)
                                <td>{{$teams->name}}</td>
                                <td>{{$teams->nama_role}}</td>
                                <td>{{$teams->nama_project}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
