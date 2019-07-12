@extends('layouts.app')

@section('content')
    <div class="container">
{{--        <h2>{{$teams->nama_project}}</h2>--}}
        <table class="table table-striped">
            <thead>
            <a href="/team/creates/{{$project->id_project}}" class="btn btn-primary pull-right">Add Team</a>
            <tr>
                <td>User</td>
                <td>Role</td>
                <td>Project</td>
                <td>Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($team_projects as $teams)
                <tr>
                    <td>{{$teams->name}}</td>
                    <td>{{$teams->nama_role}}</td>
                    <td>{{$teams->nama_project}}</td>

                    <td><a href="/team/{{$teams->id_team_projects}}/edit" class="btn btn-primary">Edit</a>

                        <form action="{{ route('teamprojects.destroy', $teams->id_team_projects)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
@endsection
