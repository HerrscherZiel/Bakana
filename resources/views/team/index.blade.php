@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
                <a href="{{url('/teams/create')}}" class="btn btn-success pull-left">Create Team</a>
            <tr>
                <td>ID</td>
                <td>User ID</td>
                <td>Project ID</td>
                <td>Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($team_projects as $teams)
                <tr>
                    <td>{{$teams->id_team_projects}}</td>
                    <td>{{$teams->user_id}}</td>
                    <td>{{$teams->project_id}}</td>
                   

                    <td><a href="/teams/{{$teams->id_team_projects}}/edit" class="btn btn-primary">Edit</a>

                    <form action="{{ route('teams.destroy', $teams->id_team_projects)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
@endsection
