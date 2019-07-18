@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <a href="{{url('/jobs/create')}}" class="btn btn-primary mb-3">Create Job</a>
            <thead>
              <tr>
                <th>Job</th>
                <th>Modul</th>
                <th>Project</th>
                <th>User</th>
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
                <td>@if ($jobs->status === 1 )
                    Ongoing
                @elseif($jobs->status === 2 )
                   Queue
                @elseif($jobs->status === 3 )
                    Pending
                @elseif($jobs->status === 4 )
                    Completed
                @endif</td></td>
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
