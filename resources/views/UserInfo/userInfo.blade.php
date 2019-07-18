@extends('layouts.app')

@section('content')

    <div class="row">
        <div>
        @foreach($users as $user)
        {{$user->name}}
        {{$user->nama_role}}
        @endforeach
        <hr>
            <br>
            @foreach($timesheets as $timesheet)
                {{$timesheet->project}}
                {{$timesheet->tgl_timesheet}}
                {{$timesheet->jam_mulai}}
                {{$timesheet->jam_selesai}}
                {{$timesheet->keterangan_timesheet}}
                <br>
            @endforeach

        @foreach($info as $infos)
<hr>
        <br>
        <div>
            <a>{{$infos->nama_project}} &nbsp</a>
            <br>
            <a>Status: <b>
                    @if ($infos->status === 1 )
                        Ongoing
                    @elseif($infos->status === 2 )
                        Queue
                    @elseif($infos->status === 3 )
                        Pending
                    @elseif($infos->status === 4 )
                        Completed
                    @endif
                </b>
            </a>
            <br>
            <div>
                {{$infos->tgl_mulai}}
                <br>
                {{$infos->tgl_selesai}}

                //ADI tambah sisa waktu

                <br>

                {{--                <a>dari: {{ date("d-m-Y", strtotime($mulai = $infos->tgl_mulai))}}</a><br>--}}
                {{--                <a>sampai: {{date("d-m-Y", strtotime($selesai = $infos->tgl_selesai))}}</a><br>--}}
                {{--                <a>Total Waktu (Hari): <b>{{$total = (strtotime($infos) - strtotime($mulai)) / (60 * 60 * 24) }}</b></a><br>--}}
                {{--                <a>Sisa Waktu (Hari): <b>{{$stotal = (strtotime($infos) - strtotime('today')) / (60 * 60 * 24) }}</b></a>--}}
            </div>
        </div>
            <a href="/userInfo/module/{{$infos->id_project}}" class="btn btn-primary">Show Modul</a>

        @endforeach


    </div>
@endsection
