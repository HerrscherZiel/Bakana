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
        <h3 class="tile-title">Create Project</h3>
        <form method="post" action="{{url('/projects/create')}}">
            <div class="tile-body">
                <div class="form-group">
                    <input type="hidden" value="{{csrf_token()}}" name="_token" />
                    <input class="form-control" name="kode_project" type="text" placeholder="Project Code">
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" name="nama_project" placeholder="Project Name">
                </div>
                <div class="form-group input-group ">
                    <input type="text" onfocus="(this.type='date')"  class="form-control" name="tgl_mulai" placeholder="Start Date">
                    <div class="mt-1 ml-3 mr-3">to</div>
                    <input type="text" onfocus="(this.type='date')"  class="form-control" name="tgl_selesai" placeholder="Finish Date">
                </div>
                <div class="form-group">
                    <select class="form-control" name="status" required="">
                        <option disabled>Select Project</option>
                            <option value=1>Ongoing</option>
                            <option value=2>Queue</option>
                    </select>

                </div>
                <div class="form-group">
                  <textarea class="form-control" rows="4" name="ket" placeholder="Description"></textarea>
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
