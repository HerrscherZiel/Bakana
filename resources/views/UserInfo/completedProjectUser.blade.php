@extends('layouts.app')

@section('content')
        @foreach($info as $infos)
            <div class="col-md-6">
                <div class="tile">
                    <div class="tile-title-w-btn">
                        <h3 class="title">{{$infos->nama_project}}</h3>
                    </div>
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-md-6">
                                <a>dari: {{ date("d M Y", strtotime($mulai = $infos->tgl_mulai))}}</a><br>
                                <a>sampai: {{date("d M Y", strtotime($selesai = $infos->tgl_selesai))}}</a>
                            </div>
                            <div class="col-md-6">
                                <a>Total Waktu : <b>{{$total = (strtotime($selesai) - strtotime($mulai)) / (60 * 60 * 24) }} Hari</b></a>
                                <br>
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
                                    </b></a>
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
