@extends('layouts.app')

@section('content')
 @foreach($project as $pro)
 <div class="card">
    <h2 class="card-header">{{$pro->nama_project}}</h2>
</div>
@endforeach 
<div class="row">
    <div class="col-md-12">
        @foreach($modulpro as $modules)
        <div class="tile pt-2 pb-0 mb-0" style="border-radius: 0">
                <div class="row">
                    <div class="col-9">
                       <a class="tile-title mr-2"><strong>{{$modules->nama_module}}</strong></a>
                        @if ($modules->status === 1 )
                        <span class="badge badge-pill badge-primary">Ongoing</span>
                            @elseif($modules->status === 2 )
                                <span class="badge badge-pill badge-secondary">Queue</span>
                            @elseif($modules->status === 3 )
                                <span class="badge badge-pill badge-warning">Pending</span>
                            @elseif($modules->status === 4 )
                                <span class="badge badge-pill badge-success">Completed</span>
                             @elseif($modules->status === 5 )
                                <span class="badge badge-pill badge-dark">Canceled</span>
                        @endif
                    </div>
                </div>
                    <div class="row invoice-info mb-2 text-secondary">
                        <div class="col-4">
                               <strong>{{date("d M Y", strtotime($mulai = $modules->tgl_mulai))}}</strong> sampai 
                                <strong>{{date("d M Y", strtotime($mulai = $modules->deadline))}}</strong>
                        </div>
                        <div class="col-3">
                           Target: <b>{{$modules->tgl_user ? date("d M Y", strtotime($mulai = $modules->tgl_user)) : " "}}</b>
                       </div>
                       <div class="col-5">
                        Keterangan: <strong>{{$modules->keterangan}}</strong>
                       </div>
                </div>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                            <tr>
                                <th style="width: 20%">Job</th>
                                <th style="width: 10%">Tanggal Mulai</th>
                                <th style="width: 10%">Deadline</th>
                                <th style="width: 10%">Sisa Waktu</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 10%">Keterangan</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($jobs as $job)
                            @if ($modules->id_module === $job->module_id)
                            <tr>
                                <td>{{$job->nama_job}}</td>
                                <td>{{date("d-m-Y", strtotime($mulai = $job->jobMulai))}}</td>
                                <td>{{date("d-m-Y", strtotime($selesai = $job->deadlineJob))}}</td>
                                <td>
                                    @if($stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) > 0 )
                                        {{$stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24)}} Hari
                                    @elseif($stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) == 0 )
                                         <span class="badge badge-warning">Deadline</span>
                                    @else
                                        <span class="badge badge-danger">Melewati<br>Deadline</span>
                                    @endif
                                </td>
                                <td>@if ($job->statusJob === 1 )
                                        <span class="badge badge-pill badge-primary">Ongoing</span>
                                    @elseif($job->statusJob === 2 )
                                        <span class="badge badge-pill badge-secondary">Queue</span>
                                    @elseif($job->statusJob === 3 )
                                        <span class="badge badge-pill badge-warning">Pending</span>
                                    @elseif($job->statusJob === 4 )
                                        <span class="badge badge-pill badge-success">Completed</span>
                                    @elseif($job->statusJob === 5 )
                                        <span class="badge badge-pill badge-dark">Canceled</span>
                                    @endif</td>
                                <td>{{$job->keterangan}}</td>
                                <td>

                                    <div class="btn-group">

                                        <a class="btn btn-info" href="/job/{{$job->id_job}}/edit">
                                            <i class="fa fa-lg fa-edit">
                                            </i>
                                        </a>
                                        @if(Auth::user()->hasRole('Project Manager'))
                                            <form action="{{ route('jobs.destroy', $job->id_job)}}" method="post">
                                                <input type="hidden" name="_method" value="DELETE">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit" onclick="archiveFunction()" style="margin-left: -2px">
                                                    <i class="fa fa-lg fa-trash">
                                                    </i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
        @endforeach
    </div>
</div>



@endsection
