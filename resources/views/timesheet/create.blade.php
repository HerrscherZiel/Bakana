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
</div>
 <a href="{{url('/timesheets/create')}}" class="btn btn-primary mb-3 mr-2" data-toggle="modal" data-target="#timesheetModal"> <i class="fa fa-plus"></i>Add Timesheet</a>
<!-- MOdal -->
<div class="modal fade" id="timesheetModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Timesheet</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <form method="post" action="{{url('/timesheets/create')}}" autocomplete="off">
            <div class="tile-body">
                <div class="form-group">
                    <input type="hidden" value="{{csrf_token()}}" name="_token" />
                    <select class="form-control" name="project" required>
                            @foreach($usher as $ushers)
                                <option value="{{$ushers->nama_project}}">{{$ushers->nama_project}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="form-group">
                  <input type="text" id="date" data-provide="datepicker" class="form-control" name="tgl_timesheet" readonly="" required>
                </div>
                <div class="form-group input-group ">
                    <input type="text" id="timepicker_start"  class="form-control" name="jam_mulai" value="08:30" placeholder="Jam Mulai" required>
                    <div class="mt-2 ml-3 mr-2">sampai</div>
                    <input type="text" id="timepicker_end"  class="form-control" name="jam_selesai" value="17:00" placeholder="Jam Selesai" required>
                </div>
                <div class="form-group">
                  <textarea class="form-control" rows="4" name="keterangan_timesheet" placeholder="Keterangan" required autofocus></textarea>
                </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Create</button>
              <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</button>
            </div>
        </form>
        </div>
        
      </div>
    </div>
</div>
@endsection
