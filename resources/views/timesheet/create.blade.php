@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
        @endif
        <div class="row">
            <form method="post" action="{{url('/timesheets/create')}}">
                <div class="form-group">
                    <input type="hidden" value="{{csrf_token()}}" name="_token" />
                    <label for="id_timesheets">ID:</label>
                    <input type="text" class="form-control" name="id_timesheets"/>
                </div>
                <div class="form-group">
                    <label for="tgl_timesheet">Tanggal:</label>
                    <input type="date" class="form-control" name="tgl_timesheet"/>
                </div>
                 <div class="form-group">
                    <label for="jam_mulai">Jam Mulai:</label>
                    <input type="time" class="form-control" name="jam_mulai"/>
                </div>
                 <div class="form-group">
                    <label for="jam_selesai">Jam Selesai:</label>
                    <input type="time" class="form-control" name="jam_selesai"/>
                </div>
                <div class="form-group">
                    <label for="keterangan_timesheet">Keterangan:</label>
                    <input type="text" class="form-control" name="keterangan_timesheet"/>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
