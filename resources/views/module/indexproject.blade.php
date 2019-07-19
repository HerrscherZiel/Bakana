@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
            <div class="row">
                <div class="col-md-10">
                    <h3>Project : {{$project->nama_project}}</h3>
                </div>
                @if(Auth::user()->hasRole('Project Manager'))
                <div class="col-md-2">
                    <a href="/module/creates/{{$project->id_project}}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i>Add Modul</a>
                </div>
                    @endif
            </div>
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th>Modul</th>
                <th>Tanggal Mulai</th>
                <th>Deadline</th>
                <th>Tanggal Selesai</th>
                <th>Status</th>
                <th>User</th>
                <th>Keterangan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach($module as $modules)
                <td>{{$modules->nama_module}}</td>
                <td>{{$modules->tgl_mulai}}</td>
                <td>{{$modules->deadline}}</td>
                <td>{{$modules->tgl_user}}</td>
                <td>@if ($modules->status === 1 )
                        Ongoing
                    @elseif($modules->status === 2 )
                        Queue
                    @elseif($modules->status === 3 )
                        Pending
                    @elseif($modules->status === 4 )
                        Completed
                    @endif</td></td>
                <td>{{$modules->user}}</td>
                <td>{{$modules->keterangan}}</td>
                <td>
                    <div class="btn-group">
                        <a class="btn btn-primary" href="/modules/{{$modules->id_module}}">
                            <i class="fa fa-lg fa-eye">
                            </i>
                        </a>
                        <a class="btn btn-info" href="/modules/{{$modules->id_module}}/edit">
                            <i class="fa fa-lg fa-edit">
                            </i>
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
    </div>
</div>
@endsection
