@extends('layouts.app')

@section('content')
     <div class="row">
      <div class="col-md-6"> 
      @if(Auth::user()->hasRole('Project Manager'))
          <a href="{{url('/projects/create')}}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Create Project</a>
      @endif
      </div>
      <div class="col-md-6 ">
        <input class="app-search__input search pull-right" placeholder="Search" >
        <div class="btn-group pull-right mr-3" role="group">
          <button class="btn btn-secondary btn-sm sort" type="button" data-sort="name">by name</button>
          <button class="btn btn-secondary btn-sm sort" type="button" data-sort="sisa">by Sisa Waktu</button>
        </div>
      </div>
    </div>
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
                            @if(Auth::user()->hasRole('Project Manager'))
                                <a class="btn btn-primary" href="/projects/{{$projects->id_project}}/edit">
                                    <i class="fa fa-lg fa-edit">
                                    </i>
                                </a>
                                <form class="delete" action="{{ route('projects.destroy', $projects->id_project)}}" method="post">
                                    <input type="hidden" name="_method" value="DELETE">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary delete-btn" style="margin-left: -2px">
                                        <i class="fa fa-lg fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-md-6">
                                <a>Project Code: <b>{{$projects->kode_project}}</b></a><br>
                                <a>Status: <b>
                                        @if ($projects->status === 1 )
                                            <span class="badge badge-pill badge-primary">Ongoing</span>
                                        @elseif($projects->status === 2 )
                                            <span class="badge badge-pill badge-secondary">Queue</span>
                                        @elseif($projects->status === 3 )
                                            <span class="badge badge-pill badge-warning">Pending</span>
                                        @elseif($projects->status === 4 )
                                            <span class="badge badge-pill badge-success">Completed</span>
                                        @elseif($projects->status === 5 )
                                            <span class="badge badge-pill badge-dark">Canceled</span>
                                        @endif
                                    </b></a>
                            </div>
                            <div class="col-md-6">
                                <a>dari: {{ date("d M Y", strtotime($mulai = $projects->tgl_mulai))}}</a><br>
                                <a>sampai: {{date("d M Y", strtotime($selesai = $projects->tgl_selesai))}}</a><br>
                                <a>Total Waktu: <b>{{$total = (strtotime($selesai) - strtotime($mulai)) / (60 * 60 * 24) }} hari</b></a><br>
                                <!-- <a>Sisa Waktu (Hari): <b>


                                        @if($stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) > 0 )
                                            {{$stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24)}} Hari
                                        @elseif($stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) == 0 )
                                            <span class="badge badge-warning">Deadline</span>
                                        @else
                                            <span class="badge badge-danger">Melewati<br>Deadline</span>
                                        @endif

                                    </b></a> -->
                            </div>
                            <div class="col-md-12">
                                <div class="content hideContent">Keterangan: <br><br>{{$projects->ket}}</div>
                                <div class="show-more"><a>Show more</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <a href="/module/{{$projects->id_project}}" class="btn btn-primary">Show Modul</a>
                        <a href="/teamAjax/{{$projects->id_project}}" class="btn btn-primary">Show Team</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
