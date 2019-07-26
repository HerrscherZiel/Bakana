

@extends('layouts.app')

@section('content')
            <div class="col-md-12">
            @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                <div class="tile">
                    <h3 class="tile-title">Project : {{$project->nama_project}}</h3>
                    <form method="post" action="{{url('/team/creates/$project->id_project')}}">
                        <div class="tile-body">
                            <div class="form-group">
                                <input type="hidden" value="{{csrf_token()}}" name="_token" />
                                <select style="display: none;" class="form-control" name="project_id" required="">
                                    <option value="{{$project->id_project}}" selected>{{$project->nama_project}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="user_id" required="">
                                    <option value="" disabled="" selected="">User</option>

                                @foreach($user as $users)
{{----}}
                                                <option value="{{$users->id}}">{{$users->name}}</option>
                                @endforeach
                    </select>
                </div>
            </div>
            <div class="tile-footer">
                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Create</button>
                <a class="btn btn-secondary" href="{{URL::previous()}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
        </form>
      </div>
    </div>
@endsection
