@extends('layouts.app')

@section('content')

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body table-responsive">
          <table class="table table-hover table-bordered" id="timesheet_table">
            <thead>
              <tr>
                <th>User</th>
                <th>Project</th>
                <th>Tanggal</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Total Waktu</th>
                <th>Keterangan</th>
            </thead>
            <tbody>
              <tr>
                 @foreach($timesheetView as $timesheets)
                <td>{{$timesheets->name}}</td>
                <td>{{$timesheets->project}}</td>
                <td>{{date("d M Y", strtotime($timesheets->tgl_timesheet))}}</td>
                <td>{{date("H:i", strtotime($mulai = $timesheets->jam_mulai))}}</td>
                <td>{{date("H:i", strtotime($selesai = $timesheets->jam_selesai))}}</td>
                <td>{{$total = (strtotime($selesai) - strtotime($mulai))/60 }} menit</td>
                <td>{{$timesheets->keterangan_timesheet}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
@endsection
