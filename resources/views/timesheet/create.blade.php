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
    <h3 class="tile-title">Add Timesheet</h3>
    <form method="post" action="{{url('/timesheets/create')}}">
        <div class="tile-body">
            <div class="form-group">
                <input type="hidden" value="{{csrf_token()}}" name="_token" />
                <select class="form-control" name="project" required="">
                        <option value="" disabled="" selected="">Select Project</option>
                        @foreach($usher as $ushers)
                            <option value="{{$ushers->nama_project}}">{{$ushers->nama_project}}</option>
                        @endforeach
                    </select>
            </div>
            <div class="form-group">
              <input type="text" id="date" data-provide="datepicker" class="form-control" name="tgl_timesheet" placeholder="Tanggal">
            </div>
            <div class="form-group input-group ">
                <input type="text" onfocus="(this.type='time')"  class="form-control" name="jam_mulai" placeholder="Jam Mulai">
                <div class="mt-1 ml-3 mr-3">to</div>
                <input type="text" onfocus="(this.type='time')"  class="form-control" name="jam_selesai" placeholder="Jam Selesai">
            </div>
            <div class="form-group">
              <textarea class="form-control" rows="4" name="keterangan_timesheet" placeholder="Keterangan" required=""></textarea>
            </div>
        </div>
        <div class="tile-footer">
          <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Create</button>
          <a class="btn btn-secondary" href="/timesheets"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
        </div>
    </form>
  </div>
</div>
@endsection
