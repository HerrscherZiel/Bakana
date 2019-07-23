@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @foreach($modulpro as $modules)
            <div class="tile">
                <section class="invoice">
                    <div class="row mb-4">
                        <div class="col-9">
                            @foreach($project as $pro)
                                <h3 class="page-header">{{$pro->nama_project}}</h3>
                                <address> <h4> <strong>{{$modules->nama_module}}</strong></h4><br>
                            @endforeach
                        </div>
                    </div>
                        <div class="row invoice-info mb-2">
                            <div class="col-4">

                                    <br>Tanggal Mulai: <strong>{{date("d-m-Y", strtotime($mulai = $modules->tgl_mulai))}}</strong>
                                    <br>Deadline: <strong>{{date("d-m-Y", strtotime($mulai = $modules->deadline))}}</strong>
                                    <br>Tanggal Selesai: <strong>{{$modules->tgl_user ? date("d-m-Y", strtotime($mulai = $modules->tgl_user)) : " "}}</strong></address>
                            </div>
                            <div class="col-4">Status: <b>@if ($modules->status === 1 )
                                        Ongoing
                                    @elseif($modules->status === 2 )
                                        Queue
                                    @elseif($modules->status === 3 )
                                        Pending
                                    @elseif($modules->status === 4 )
                                        Completed
                                        @endif</b>
{{--                                </b><br>User:<br><b>{{$modules->user}}</b>--}}
                                <br>Keterangan:<br><b>{{$modules->keterangan}}</b></div>
                    </div>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped" id="sampleTable">
                                <thead>
                                <tr>
                                    <th>Job</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Deadline</th>
{{--                                    <th>Tanggal Target</th>--}}
                                    <th>Sisa Waktu</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                {{--                                @foreach($job as $jobs)--}}

                                @foreach($jobs as $job)
                                    @if ($modules->id_module === $job->module_id)
                                                                    <tr>
                                                                        <td>{{$job->nama_job}}</td>
                                                                        <td>{{date("d-m-Y", strtotime($mulai = $job->jobMulai))}}</td>
                                                                        <td>{{date("d-m-Y", strtotime($selesai = $job->deadlineJob))}}</td>
{{--                                                                        <td>{{$jobs->tgl_user ? date("d-m-Y", strtotime($jobs->tgl_user)) : ''}}</td>--}}
                                                                        <td>
                                                                            @if($stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) > 0 )
                                                                                {{$stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24)}} Hari
                                                                            @elseif($stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) == 0 )
                                                                                Deadline
                                                                            @else
                                                                                Melewati Deadline
                                                                            @endif
                                                                        </td>
                                                                        <td>@if ($job->status === 1 )
                                                                                Ongoing
                                                                            @elseif($job->status === 2 )
                                                                                Queue
                                                                            @elseif($job->status === 3 )
                                                                                Pending
                                                                            @elseif($job->status === 4 )
                                                                                Completed
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
                                {{--                                @endforeach--}}
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>
            </div>
            @endforeach
        </div>
    </div>



@endsection
