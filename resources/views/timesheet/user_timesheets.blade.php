@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
            <a href="{{url('/timesheets/create/')}}" class="btn btn-success pull-left">Add Timesheet</a>
            <tr>
                <td>ID</td>
                <td>User</td>
                <td>Project</td>
                <td>Tanggal</td>
                <td>Jam Mulai</td>
                <td>Jam Selesai</td>
                <td>Total Waktu (Minute)</td>
                <td>Keterangan</td>

                <td>Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($timesheetView as $timesheets)
                <tr>

                    <td>{{$timesheets->id_timesheets}}</td>
                    <td>{{$timesheets->name}}</td>
                    <td>{{$timesheets->project}}</td>
                    <td>{{date("d-m-Y", strtotime($timesheets->tgl_timesheet))}}</td>
                    <td>{{$mulai = $timesheets->jam_mulai}}</td>
                    <td>{{$selesai = $timesheets->jam_selesai}}</td>
                    <td>{{$total = (strtotime($selesai) - strtotime($mulai))/60 }}</td>
                    <td>{{$timesheets->keterangan_timesheet}}</td>



                    <td><a href="/timesheets/{{$timesheets->id_timesheets}}/edit" class="btn btn-primary">Edit</a>

                        <form action="{{ route('timesheets.destroy', $timesheets->id_timesheets)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
