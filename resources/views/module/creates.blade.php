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
        <h3 class="tile-title">Add Modul</h3>
        <form method="post" action="{{url('/modules/create')}}">
            <div class="tile-body">
                <div class="form-group">
                    <input type="hidden" value="{{csrf_token()}}" name="_token" />
                    <select class="form-control" name="project_id">
                        <option value="{{$project->id_project}}" selected>{{$project->nama_project}}</option>
                    </select>
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" name="nama_module" placeholder="Module Name">
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" name="waktu" placeholder="Duration">
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" name="status" placeholder="Status">
                </div>
                <div class="form-group">
                  <textarea class="form-control" rows="4" name="keterangan" placeholder="Description"></textarea>
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
