@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <section class="invoice">
          <div class="row mb-4">
            <div class="col-9">
              <h2 class="page-header">{{$project->nama_project}}</h2>
            </div>
              @if(Auth::user()->hasRole('Project Manager'))
              <div class="col-3">
                <a href="/team/creates/{{$project->id_project}}" class="btn btn-primary pull-right "><i class="fa fa-plus"></i>Add Team</a>
                <a href="/module/creates/{{$project->id_project}}" class="btn btn-primary pull-right mr-2"><i class="fa fa-plus"></i>Add Module</a>
            </div>
                  @endif
          </div>
          <div class="row invoice-info">
            <div class="col-4">Project Code
              <address><strong>{{$project->kode_project}}</strong><br><br>
                Status: <b>
                @if ($project->status === 1 )
                        Ongoing
                    @elseif($project->status === 2 )
                        Queue
                    @elseif($project->status === 3 )
                        Pending
                    @elseif($project->status === 4 )
                        Completed
                    @endif
                    </b></address>
            </div>
            <div class="col-4">From
              <address><strong>{{$project->tgl_mulai}}</strong><br>to<br><strong>{{$project->tgl_selesai}}</strong></address>
            </div>
            <div class="col-4">Keterangan:<br><b>{{$project->ket}}</b></div>
          </div>
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Modul</th>
                    <th>Waktu</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($module as $modules)
                  <tr>
                    <td>{{$modules->nama_module}}</td>
                    <td>{{$modules->waktu}}</td>
                    <td> @if ($modules->status === 1 )
                            Ongoing
                        @elseif($modules->status === 2 )
                            Queue
                        @elseif($modules->status === 3 )
                            Pending
                        @elseif($modules->status === 4 )
                            Completed
                        @endif</td>
                    <td>{{$modules->keterangan}}</td>
                    <td>
                        <div class="btn-group">
                          <a class="btn btn-primary" href="/modules/{{$modules->id_module}}">
                            <i class="fa fa-lg fa-eye">
                            </i>
                        </a>
                            @if(Auth::user()->hasRole('Project Manager'))
                            <a class="btn btn-info" href="/modules/{{$modules->id_module}}/edit">
                            <i class="fa fa-lg fa-edit">
                            </i>
                        </a>
                            <form class="delete" action="{{ route('modules.destroy', $modules->id_module)}}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit" style="margin-left: -2px">
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
