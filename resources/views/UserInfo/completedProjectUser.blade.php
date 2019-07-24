@extends('layouts.app')

@section('content')

{{--        <div class="col-md-12">--}}
{{--            <div class="tile">--}}
{{--                <div class="tile-body">--}}
{{--                    <table class="table table-striped">--}}
{{--                        <a href="{{url('/timesheets/create')}}" class="btn btn-primary mb-3 mr-2"> <i class="fa fa-plus"></i>Add Timesheet</a>--}}
{{--                        <h3>Your Last Timesheet</h3>--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>Project</th>--}}
{{--                            <th>Tanggal</th>--}}
{{--                            <th>Jam Mulai</th>--}}
{{--                            <th>Jam Selesai</th>--}}
{{--                            <th>Total Waktu</th>--}}
{{--                            <th>Keterangan</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        <tr>--}}
{{--                            @foreach($timesheets as $timesheet)--}}
{{--                                <td>{{$timesheet->project}}</td>--}}
{{--                                <td>{{date("d-m-Y", strtotime($timesheet->tgl_timesheet))}}</td>--}}
{{--                                <td>{{$mulai = $timesheet->jam_mulai}}</td>--}}
{{--                                <td>{{$selesai = $timesheet->jam_selesai}}</td>--}}
{{--                                <td>{{$total = (strtotime($selesai) - strtotime($mulai))/60 }} menit</td>--}}
{{--                                <td>{{$timesheet->keterangan_timesheet}}</td>--}}
{{--                        </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                    <div class="row d-print-none mt-2">--}}
{{--                        <div class="col-12 text-right"><a href="{{url('/timesheetss')}}" class="btn btn-warning pull-right">Show More</a></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        @foreach($info as $infos)
            <div class="col-md-6">
                <div class="tile">
                    <div class="tile-title-w-btn">
                        <h3 class="title">{{$infos->nama_project}}</h3>
                    </div>
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-md-6">
                                <a>Status: <b>
                                        @if ($infos->status === 1 )
                                            <span class="badge badge-pill badge-primary">Ongoing</span>
                                        @elseif($infos->status === 2 )
                                            <span class="badge badge-pill badge-secondary">Queue</span>
                                        @elseif($infos->status === 3 )
                                            <span class="badge badge-pill badge-warning">Pending</span>
                                        @elseif($infos->status === 4 )
                                            <span class="badge badge-pill badge-success">Completed</span>
                                        @elseif($infos->status === 5 )
                                            <span class="badge badge-pill badge-dark">Canceled</span>
                                        @endif
                                    </b></a><br>
                                <a>dari: {{ date("d-m-Y", strtotime($mulai = $infos->tgl_mulai))}}</a><br>
                                <a>sampai: {{date("d-m-Y", strtotime($selesai = $infos->tgl_selesai))}}</a>
                            </div>
                            <div class="col-md-6">

                                <a>Total Waktu (Hari): <b>{{$total = (strtotime($selesai) - strtotime($mulai)) / (60 * 60 * 24) }}</b></a><br>
                                <a>Sisa Waktu (Hari): <b>{{$stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) }}</b></a>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <a href="/userInfo/module/{{$infos->id_project}}" class="btn btn-primary">Show Modul</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
