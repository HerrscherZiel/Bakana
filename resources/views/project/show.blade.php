@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <section class="invoice">
          <div class="row mb-4">
            <div class="col-8">



                    <h2 class="page-header">{{$project->nama_project}}</h2>
            </div>
              @if(Auth::user()->hasRole('Project Manager'))
              <div class="col-4">
                <a href="/team/creates/{{$project->id_project}}" class="btn btn-primary pull-right  ml-2 mb-2"><i class="fa fa-plus"></i>Add Team</a>
                <a href="/module/creates/{{$project->id_project}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>Add Module</a>
            </div>
                  @endif
          </div>
          <div class="row invoice-info">
            <div class="col-4">Project Code
              <address><strong>{{$project->kode_project}}</strong><br><br>
                Status: <b>
                @if ($project->status === 1 )
                        <span class="badge badge-pill badge-primary">Ongoing</span>
                    @elseif($project->status === 2 )
                        <span class="badge badge-pill badge-secondary">Queue</span>
                    @elseif($project->status === 3 )
                        <span class="badge badge-pill badge-warning">Pending</span>
                    @elseif($project->status === 4 )
                        <span class="badge badge-pill badge-success">Completed</span>
                    @endif
                    </b></address>
            </div>
            <div class="col-4">Dari
              <address><strong>{{date("d-m-Y", strtotime($mulai = $project->tgl_mulai))}}</strong><br>sampai<br><strong>{{date("d-m-Y", strtotime($mulai = $project->tgl_selesai))}}</strong></address>
            </div>
            <div class="col-4">Keterangan:<br><b>{{$project->ket}}</b></div>
          </div>
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-striped" id="sampleTable">
                <thead>
                  <tr>
                    <th>Modul</th>
                    <th>Tanggal Mulai</th>
                    <th>Deadline</th>
                    <th>Tanggal Selesai</th>
                    <th>Sisa Waktu</th>
                    <th>Status</th>
                    <th>User</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($module as $modules)
                  <tr>
                    <td>{{$modules->nama_module}}</td>
                    <td>{{date("d-m-Y", strtotime($mulai = $modules->tgl_mulai))}}</td>
                    <td>{{date("d-m-Y", strtotime($selesai = $modules->deadline))}}</td>
                    <td>{{$modules->tgl_user ? date("d-m-Y", strtotime($modules->tgl_user)) : " "}}</td>
                    <td>
                     @if($stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) > 0 )
                           {{$stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24)}} Hari
                           @elseif($stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) == 0 )
                           Deadline
                           @else
                            Melewati Deadline
                       @endif
                </td>
                    <td> @if ($modules->status === 1 )
                             <span class="badge badge-pill badge-primary">Ongoing</span>
                        @elseif($modules->status === 2 )
                            <span class="badge badge-pill badge-secondary">Queue</span>
                        @elseif($modules->status === 3 )
                            <span class="badge badge-pill badge-warning">Pending</span>
                        @elseif($modules->status === 4 )
                            <span class="badge badge-pill badge-success">Completed</span>
                        @endif</td>
                    <td>{{$modules->user}}</td>
                    <td>{{$modules->keterangan}}</td>
                    <td>
                        <div class="btn-group">
                          <a class="btn btn-primary" href="/modules/{{$modules->id_module}}">
                            <i class="fa fa-lg fa-eye">
                            </i>
                        </a>
{{--                            @if(Auth::user()->hasRole('Project Manager'))--}}
                            <a class="btn btn-info" href="/module/{{$modules->id_module}}/edit">
                            <i class="fa fa-lg fa-edit">
                            </i>
                           {{--     @elseif( $aa = $as)
                                    <a class="btn btn-info" href="/module/{{$modules->id_module}}/edit">
                                        <i class="fa fa-lg fa-edit">
                                        </i>
                                @endif--}}
                        </a>
                                @if(Auth::user()->hasRole('Project Manager'))
                                <form class="delete" action="{{ route('modules.destroy', $modules->id_module)}}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger delete-btn" type="submit" style="margin-left: -2px">
                                <i class="fa fa-lg fa-trash">
                                </i>
                                </button>
                            </form>
                                @endif
                    </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="row d-print-none mt-2">
            <div class="col-12 text-right"><small>Written On {{$project->created_at}}</small></div>
          </div>
        </section>
      </div>
    </div>
  </div>
@endsection
