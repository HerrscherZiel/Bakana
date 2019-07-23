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
        <h3 class="tile-title">Edit Timesheet</h3>
        <form method="post" action="{{ route('timesheets.update', $timesheet->id_timesheets) }}" autocomplete="off">
            @method('PATCH')
            @csrf
            <div class="tile-body">
                 <div class="form-group">
                    <label class="control-label">Tanggal</label>
                  <input id="date" data-provide="datepicker" class="form-control" name="tgl_timesheet"  value="{{ $timesheet->tgl_timesheet }}" readonly="">
                </div>
                 <div class="form-group">
                    <label class="control-label">Jam Mulai</label>
                  <input id="timepicker_start"  class="form-control" name="jam_mulai"  value={{ $timesheet->jam_mulai }}>
                </div>
                 <div class="form-group">
                    <label class="control-label">Jam Selesai</label>
                  <input id="timepicker_end" class="form-control" name="jam_selesai"  value={{ $timesheet->jam_selesai }}>
                </div>
                 <div class="form-group">
                    <label class="control-label">Keterangan</label>
                  <textarea class="form-control" rows="4" name="keterangan_timesheet">{{ $timesheet->keterangan_timesheet }}</textarea>
                </div>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
              <a class="btn btn-secondary" href="{{URL::previous()}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
        </form>
      </div>
</div>
@endsection
