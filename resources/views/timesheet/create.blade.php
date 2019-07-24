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
    <form method="post" action="{{url('/timesheets/create')}}" autocomplete="off">
        <div class="tile-body">
            <div class="form-group">
                <input type="hidden" value="{{csrf_token()}}" name="_token" />
                <select class="form-control" name="project">
                        <option value="" disabled="" selected="">Select Project</option>
                        @foreach($usher as $ushers)
                            <option value="{{$ushers->nama_project}}">{{$ushers->nama_project}}</option>
                        @endforeach
                    </select>
            </div>
            <div class="form-group">
              <input type="text" id="date" data-provide="datepicker" class="form-control" name="tgl_timesheet" placeholder="Tanggal" readonly="">
            </div>
            <div class="form-group input-group ">
                <input type="text" id="timepicker_start"  class="form-control" name="jam_mulai" placeholder="Jam Mulai">
                <div class="mt-2 ml-3 mr-2">sampai</div>
                <input type="text" id="timepicker_end"  class="form-control" name="jam_selesai" placeholder="Jam Selesai">
            </div>
            <div class="form-group">
              <textarea class="form-control" rows="4" name="keterangan_timesheet" placeholder="Keterangan"></textarea>
            </div>
        </div>
        <div class="tile-footer">
          <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Create</button>
          <a class="btn btn-secondary" href="{{URL::previous()}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
        </div>
    </form>
  </div>
</div>

<script type="text/javascript" src="{{URL::asset('js/include/jquery-1.9.0.min.js')}}"></script>
@endsection
