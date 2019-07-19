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
        <h3 class="tile-title">Project {{$project->nama_project}}</h3>
        <form method="post" action="{{url('/modules/create')}}">
            <div class="tile-body">
                <div class="form-group">
                    <input type="hidden" value="{{csrf_token()}}" name="_token" />
                    <select style="display: none" class="form-control" name="project_id">
                        <option value="{{$project->id_project}}" selected>{{$project->nama_project}}</option>
                    </select>
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" name="nama_module" placeholder="Module Name">
                </div>
                <div class="form-group">
                    <select class="form-control" name="user" required="">
                        <option disabled="" selected="">Select Project</option>
                        @foreach($mod as $mods)
                            <option value="{{$mods->name}}">{{$mods->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group input-group">
                    <input id="date1" class="form-control" name="tgl_mulai" placeholder="Start Date">
                    <div class="mt-1 ml-3 mr-3">to</div>
                    <input id="date2" class="form-control" name="deadline" placeholder="Finish Date">
                </div>
                <div class="form-group input-group">
                    <input id="date1" class="form-control" name="tgl_user" placeholder="Selesai pada">
                </div>
                <div class="form-group">
                <select class="form-control" name="status" required="">
                    <option disabled>Select Project</option>
                    <option value=1>Ongoing</option>
                    <option value=2>Queue</option>
                    {{--                        <option value=3>Pending</option>--}}
                    {{--                        <option value=4>Completed</option>--}}
                </select>
            </div>
                <div class="form-group">
                  <textarea class="form-control" rows="4" name="keterangan" placeholder="Description"></textarea>
                </div>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Create</button>
              <a class="btn btn-secondary" href="javascript:history.go(-1)"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
        </form>
      </div>
</div>

@endsection
