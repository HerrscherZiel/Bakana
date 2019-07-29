@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <a href="{{url('/jobs/create')}}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Create Job</a>
        <a href="{{url('/completedJob')}}" class="btn btn-success mb-3"><i class="fa fa-check"></i> Completed Job</a>
        <div class="tile-body table-responsive">
          <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
              <tr>
                <th>Job</th>
                <th>Modul</th>
                <th>Project</th>
                <th>User</th>
                <th>Tanggal Mulai</th>
                <th>Deadline</th>
                <th>Tanggal Target</th>
                <th>Sisa Waktu</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach($job as $jobs)
                <td>{{$jobs->nama_job}}</td>
                <td>{{$jobs->nama_module}}</td>
                <td>{{$jobs->nama_project}}</td>
                <td>{{$jobs->user}}</td>
                <td>{{date("d-m-Y", strtotime($mulai = $jobs->tgl_mulai))}}</td>
                <td>{{date("d-m-Y", strtotime($selesai = $jobs->deadline))}}</td>
                <td>{{$jobs->tgl_user ? date("d-m-Y", strtotime($jobs->tgl_user)) : ''}}</td>
                <td>
                    @if($stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) > 0 )
                        {{$stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24)}} Hari
                    @elseif($stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) == 0 )
                        <span class="badge badge-warning">Deadline</span>
                    @else
                        <span class="badge badge-danger">Melewati<br>Deadline</span>
                    @endif
                </td>
                <td>@if ($jobs->status === 1 )
                    <span class="badge badge-pill badge-primary">Ongoing</span>
                @elseif($jobs->status === 2 )
                   <span class="badge badge-pill badge-secondary">Queue</span>
                @elseif($jobs->status === 3 )
                    <span class="badge badge-pill badge-warning">Pending</span>
                @elseif($jobs->status === 4 )
                    <span class="badge badge-pill badge-success">Completed</span>
                @elseif($jobs->status === 5 )
                    <span class="badge badge-pill badge-dark">Canceled</span>
                @endif</td>
                <td>{{$jobs->keterangan}}</td>
                <td>
                    @if(Auth::user()->hasRole('Project Manager'))
                    <div class="btn-group">
                        <a class="btn btn-info" href="/jobs/{{$jobs->id_job}}/edit">
                            <i class="fa fa-lg fa-edit">
                            </i>
                        </a>
                            <form class="delete" action="{{ route('jobs.destroy', $jobs->id_job)}}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-btn" style="margin-left: -2px">
                                <i class="fa fa-lg fa-trash">
                                </i>
                                </button>
                            </form>
                    </div>
                        @endif
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
