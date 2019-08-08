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
        <h3 class="tile-title">Create Team</h3>
        <form method="post" action="{{url('/teamprojects/create')}}">
            <div class="tile-body">
                <div class="form-group">
                    <input type="hidden" value="{{csrf_token()}}" name="_token" />
                    <select class="form-control" name="project_id" required="">
                            <option value="" disabled="" selected="">Select Project</option>
                            @foreach($project as $projects)
                                <option value="{{$projects->id_project}}">{{$projects->nama_project}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="form-group">
                    <select class="form-control" name="user_id" required="">
                           <!-- <optgroup label="Pilih User">  -->
                            @foreach($user as $users)
                                <option value="{{$users->id}}">{{$users->name}}</option>
                            @endforeach
                            <!-- </optgroup> -->
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
