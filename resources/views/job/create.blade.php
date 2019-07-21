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
        <h3 class="tile-title">Add Job</h3>
        <form method="post" action="{{url('/jobs/create')}}">
            <div class="tile-body">
                <div class="form-group">
                    <input type="hidden" value="{{csrf_token()}}" name="_token" />
                    <select class="form-control" name="module_id" required="">
                        <option disabled="" selected="">Select Module</option>
                        @foreach($module as $modules)
                        <option value="{{$modules->id_module}}">{{$modules->nama_module}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" name="nama_job" placeholder="Nama Job">
                </div>
                <div class="form-group">
                    <select class="form-control" name="user" required="">
                        <option value="" disabled selected="">Select User</option>

                    @foreach($mod as $mods)
                        <option value="{{$mods->name}}">{{$mods->name}}</option>
                        @endforeach
                    </select>
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
                  <textarea class="form-control" rows="4" name="keterangan" placeholder="Keterangan"></textarea>
                </div>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Create</button>
              <a class="btn btn-secondary" href="/projects"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
        </form>
      </div>
</div>
@endsection
