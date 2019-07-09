@extends('layouts.app')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Edit Timesheet
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post" action="{{ route('timesheets.update', $timesheet->id_timesheets) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="id_timesheets">ID:</label>
                    <input type="text" class="form-control" name="id_timesheets" value={{ $timesheet->id_timesheets }} />
                </div>
                <div class="form-group">
                    <label for="tgl_timesheet">Tanggal:</label>
                    <input type="date" class="form-control" name="tgl_timesheet" value={{ $timesheet->tgl_timesheet }} />
                </div>
                <div class="form-group">
                    <label for="jam_mulai">Jam Mulai:</label>
                    <input type="time" class="form-control" name="jam_mulai" value={{ $timesheet->jam_mulai }} />
                </div>
                <div class="form-group">
                    <label for="jam_selesai">Jam Selesai:</label>
                    <input type="time" class="form-control" name="jam_selesai" value={{ $timesheet->jam_selesai }} />
                </div>
                <div class="form-group">
                    <label for="keterangan_timesheet">Keterangan:</label>
                    <input type="text" class="form-control" name="keterangan_timesheet" value={{ $timesheet->keterangan_timesheet }} />
                </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
