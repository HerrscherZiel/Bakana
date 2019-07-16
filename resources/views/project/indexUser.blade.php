@extends('layouts.user')

@section('content')
    <div class="row">
        @foreach($project as $projects)
            <div class="col-md-6">
                <div class="tile">
                    <div class="tile-title-w-btn">
                        <h3 class="title">{{$projects->nama_project}}</h3>

                        <div class="btn-group ">
                            <a class="btn btn-primary" href="/projects/{{$projects->id_project}}">
                                <i class="fa fa-lg fa-eye">
                                </i>
                            </a>
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-md-6">
                                <a>Project Code: <b>{{$projects->kode_project}}</b></a><br>
                                <a>Status: <b>
                                        @if ($projects->status === 1 )
                                            Ongoing
                                        @elseif($projects->status === 2 )
                                            Queue
                                        @elseif($projects->status === 3 )
                                            Pending
                                        @elseif($projects->status === 4 )
                                            Completed
                                        @endif
                                    </b></a>
                            </div>
                            <div class="col-md-6">
                                <a>dari: {{ date("d-m-Y", strtotime($mulai = $projects->tgl_mulai))}}</a><br>
                                <a>sampai: {{date("d-m-Y", strtotime($selesai = $projects->tgl_selesai))}}</a><br>
                                <a>Total Waktu (Hari): <b>{{$total = (strtotime($selesai) - strtotime($mulai)) / (60 * 60 * 24) }}</b></a><br>
                                <a>Sisa Waktu (Hari): <b>{{$stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) }}</b></a>
                            </div>
                            <div class="col-md-12">
                                <a>Keterangan: <br>{{$projects->ket}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <a href="/module/{{$projects->id_project}}" class="btn btn-primary">Show Modul</a>
                        <a href="/team/{{$projects->id_project}}" class="btn btn-primary">Show Team</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
