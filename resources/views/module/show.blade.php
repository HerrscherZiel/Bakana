@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <section class="invoice">
          <div class="row mb-4">
            <div class="col-9">
                @foreach($module as $modules)
              <h2 class="page-header">{{$modules->nama_module}}</h2>
              @endforeach
            </div>
              @if(Auth::user()->hasRole('Project Manager'))
              <div class="col-3">
                <a href="/jobs/creates/{{$mod->id_module}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>Add Job</a>
            </div>
                  @endif
          </div>
          <div class="row invoice-info mb-2">
            @foreach($module as $modules)
            <div class="col-4">
              <address>Project: <strong>{{$modules->nama_project}}</strong><br>

                  <br>Tanggal Mulai: <strong>{{date("d-m-Y", strtotime($mulai = $modules->tgl_mulai))}}</strong>
                  <br>Deadline: <strong>{{date("d-m-Y", strtotime($mulai = $modules->deadline))}}</strong>
                  <br>Tanggal Selesai: <strong>{{date("d-m-Y", strtotime($mulai = $modules->tgl_user))}}</strong></address>
            </div>
            <div class="col-4">Status: <b>@if ($modules->status === 1 )
                        Ongoing
                    @elseif($modules->status === 2 )
                        Queue
                    @elseif($modules->status === 3 )
                        Pending
                    @elseif($modules->status === 4 )
                        Completed
                        @endif</td>
                </b><br>User:<br><b>{{$modules->user}}</b>
                <br>Keterangan:<br><b>{{$modules->keterangan}}</b></div>
             @endforeach
          </div>
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-striped" id="sampleTable">
                <thead>
                  <tr>
                    <th>Job</th>
                    <th>Module</th>
                    <th>User</th>
                    <th>Keterangan</th>
                      @if(Auth::user()->hasRole('Project Manager'))
                      <th>Action</th>
                          @endif
                  </tr>
                </thead>
                <tbody>
                @foreach($job as $jobs)
                  <tr>
                    <td>{{$jobs->nama_job}}</td>
                    <td>{{$jobs->nama_module}}</td>
                    <td>{{$jobs->user}}</td>
                    <td>{{$jobs->keterangan}}</td>
                      @if(Auth::user()->hasRole('Project Manager'))
                      <td>

                        <div class="btn-group">
                        
                        <a class="btn btn-info" href="/job/{{$jobs->id_job}}/edit">
                            <i class="fa fa-lg fa-edit">
                            </i>
                        </a>
                            <form action="{{ route('jobs.destroy', $jobs->id_job)}}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit" onclick="archiveFunction()" style="margin-left: -2px">
                                <i class="fa fa-lg fa-trash">
                                </i>
                                </button>
                            </form>
                        </div>
                    </td>
                      @endif
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="row d-print-none mt-2">
            @foreach($module as $modules)
            <div class="col-12 text-right"><small>Written On {{$modules->created_at}}</small></div>
            @endforeach
          </div>
        </section>
      </div>
    </div>
</div> 



@endsection
