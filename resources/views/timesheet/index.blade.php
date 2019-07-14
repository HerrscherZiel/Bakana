@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <a href="{{url('/timesheets/create')}}" class="btn btn-primary mb-3">Add Timesheet</a>
            <thead>
              <tr>
                <th>User</th>
                <th>Project</th>
                <th>Tanggal</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Total Waktu (Menit)</th>
                <th>Keterangan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                 @foreach($timesheetView as $timesheets)
                <td>{{$timesheets->name}}</td>
                <td>{{$timesheets->project}}</td>
                <td>{{$timesheets->tgl_timesheet}}</td>
                <td>{{$mulai = $timesheets->jam_mulai}}</td>
                <td>{{$selesai = $timesheets->jam_selesai}}</td>
                <td>{{$total = (strtotime($selesai) - strtotime($mulai))/60 }}</td>
                <td>{{$timesheets->keterangan_timesheet}}</td>
                <td>
                    <div class="btn-group">
                        <a class="btn btn-info" href="/timesheets/{{$timesheets->id_timesheets}}/edit">
                            <i class="fa fa-lg fa-edit">
                            </i>
                        </a>
                            <form class="delete" action="{{ route('timesheets.destroy', $timesheets->id_timesheets)}}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit" style="margin-left: -2px">
                                <i class="fa fa-lg fa-trash">
                                </i>
                                </button>
                            </form>
                    </div>
                </td>
              </tr>
               @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
@endsection
