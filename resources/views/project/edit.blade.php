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
    <h3 class="tile-title">Edit Project</h3>
    <form method="post" action="{{ route('projects.update', $project->id_project) }}">
        @method('PATCH')
                @csrf
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label">Project Code</label>
                <input type="hidden" value="{{csrf_token()}}" name="_token" />
                <input class="form-control" name="kode_project" type="text" value={{ $project->kode_project }}>
            </div>
            <div class="form-group">
                <label class="control-label">Project Name</label>
              <input class="form-control" type="text" name="nama_project" value={{ $project->nama_project }}>
            </div>
            <div class="form-group input-group ">
                <label class="control-label mt-2 mr-2">Start Date</label>
                <input type="text" onfocus="(this.type='date')"  class="form-control" name="tgl_mulai" value={{ $project->tgl_mulai }}>
                <label class="control-label mt-2 ml-5 mr-2">Finish Date</label>
                <input type="text" onfocus="(this.type='date')"  class="form-control" name="tgl_selesai" value={{ $project->tgl_selesai }}>
            </div>
            <div class="form-group">
                <label class="control-label">Status</label>
              <input class="form-control" type="text" name="status" value={{ $project->status }}>
            </div>
            <div class="form-group">
                <label class="control-label">Description</label>
              <textarea class="form-control" rows="4" name="ket">{{ $project->ket }}</textarea>
            </div>
        </div>
        <div class="tile-footer">
          <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
          <a class="btn btn-secondary" href="/projects"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
        </div>
    </form>
  </div>
</div>

@endsection
