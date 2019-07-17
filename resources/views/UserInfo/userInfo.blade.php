@extends('layouts.app')

@section('content')

    <div class="row">
        <div>
        @foreach($users as $user)
        {{$user->name}}
        {{$user->nama_role}}
        @endforeach
        <hr>
        </div>
        //nek iso project e option value, select pertama ning project pertama
        @foreach($info as $infos)
<hr>
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
        <div>
{{--            @foreach($modulpro as $mod)--}}
{{--                <div>--}}

{{--                    {{ $mod->nama_module }}--}}

{{--                </div>--}}


{{--            @endforeach--}}
        </div>
        <br>

        <br>
        <br>

        {{--            <div class="col-md-6">--}}
        {{--                <div class="tile">--}}
        {{--                    <div class="tile-title-w-btn">--}}
        {{--                        <h3 class="title">{{$infos->nama_project}}</h3>--}}

        {{--                        <div class="btn-group ">--}}
        {{--                            <a class="btn btn-primary" href="--}}{{--/projects/{{$projects->id_project}}--}}{{--">--}}
        {{--                                <i class="fa fa-lg fa-eye">--}}
        {{--                                </i>--}}
        {{--                            </a>--}}
        {{--                            @if(Auth::user()->hasRole('Project Manager'))--}}
        {{--                                <a class="btn btn-primary" href="/projects/{{$projects->id_project}}/edit">--}}
        {{--                                    <i class="fa fa-lg fa-edit">--}}
        {{--                                    </i>--}}
        {{--                                </a>--}}
        {{--                                <form class="delete" action="{{ route('projects.destroy', $projects->id_project)}}" method="post">--}}
        {{--                                    <input type="hidden" name="_method" value="DELETE">--}}
        {{--                                    @csrf--}}
        {{--                                    @method('DELETE')--}}
        {{--                                    <button class="btn btn-primary" style="margin-left: -2px">--}}
        {{--                                        <i class="fa fa-lg fa-trash"></i>--}}
        {{--                                    </button>--}}
        {{--                                </form>--}}
        {{--                            @endif--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="tile-body">--}}
        {{--                        <div class="row">--}}
        {{--                            <div class="col-md-6">--}}
        {{--                                <a>{{$info->nama_role}}</a>--}}
        {{--                                <h3 class="title">{{$infos->nama_project}}</h3>--}}


        {{--                                <a>Project Code: <b>{{$infos->kode_project}}</b></a><br>--}}

        {{--                                <a>Status: <b>--}}
        {{--                                        @if ($infos->status === 1 )--}}
        {{--                                            Ongoing--}}
        {{--                                        @elseif($infos->status === 2 )--}}
        {{--                                            Queue--}}
        {{--                                        @elseif($infos->status === 3 )--}}
        {{--                                            Pending--}}
        {{--                                        @elseif($infos->status === 4 )--}}
        {{--                                            Completed--}}
        {{--                                        @endif--}}
        {{--                                    </b>--}}
        {{--                                </a>--}}

        {{--                            </div>--}}
        {{--                            <div class="col-md-6">--}}
        {{--                                <a>dari: {{ date("d-m-Y", strtotime($mulai = $infos->tgl_mulai))}}</a><br>--}}
        {{--                                <a>sampai: {{date("d-m-Y", strtotime($selesai = $infos->tgl_selesai))}}</a><br>--}}
        {{--                                <a>Total Waktu (Hari): <b>{{$total = (strtotime($infos) - strtotime($mulai)) / (60 * 60 * 24) }}</b></a><br>--}}
        {{--                                <a>Sisa Waktu (Hari): <b>{{$stotal = (strtotime($infos) - strtotime('today')) / (60 * 60 * 24) }}</b></a>--}}
        {{--                            </div>--}}
        {{--                            <div class="col-md-12">--}}
        {{--                                <div class="content hideContent">Keterangan: <br><br>{{$infos->ket}}</div>--}}
        {{--                                <div class="show-more"><a>Show more</a></div>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="tile-footer">--}}
        {{--                        <a href="/module/{{$infos->id_project}}" class="btn btn-primary">Show Modul</a>--}}
        {{--                        <a href="/team/{{$infos->id_project}}" class="btn btn-primary">Show Team</a>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
            <br><br><br>
    </div>
@endsection
