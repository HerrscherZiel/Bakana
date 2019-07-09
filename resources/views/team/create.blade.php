@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
        @endif
        <div class="row">
            <form method="post" action="{{url('/teams/create')}}">
                <div class="form-group">
                    <input type="hidden" value="{{csrf_token()}}" name="_token" />
                    <label for="id_team_projects">ID:</label>
                    <input type="text" class="form-control" name="id"/>
                </div>
                <div class="form-group">
                    <label for="user_id">User ID:</label>
                    <input type="text" class="form-control" name="user_id"/>
                </div>
                 <div class="form-group">
                    <label for="project_id">Project ID:</label>
                    <input type="text" class="form-control" name="project_id"/>
                </div>
                
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
