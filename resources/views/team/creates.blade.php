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
            <form method="post" action="{{url('/teamprojects/create')}}">
                <div class="form-group">
                    <input type="hidden" value="{{csrf_token()}}" name="_token" />
                    <label for="user_id">User:</label>
                    <select name="user_id" id="" class="form-control">
                        @foreach($user as $users)
                            <option value="{{$users->id}}">{{$users->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">

                    <label for="nama_project">Project Name:</label>
                    {{--<input type="text" class="form-control" name="nama_project"/>--}}
                    <select class="form-control" name="project_id">
                        <option value="{{$project->id_project}}" selected>{{$project->nama_project}}</option>
                    </select>
                </div>
{{--                <div class="form-group">--}}
{{--                    <label for="project_id">Project:</label>--}}
{{--                    <select name="project_id" id="" class="form-control">--}}
{{--                        @foreach($project as $projects)--}}
{{--                            <option value="{{$projects->id_project}}">{{$projects->nama_project}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}

                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
