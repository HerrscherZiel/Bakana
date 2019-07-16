@extends('layouts.user')

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
                    </div>
                    <div class="row invoice-info mb-2">
                        @foreach($module as $modules)
                            <div class="col-4">
                                <address>Project: <strong>{{$modules->nama_project}}</strong><br><br>Durasi: <strong>{{$modules->waktu}}</strong></address>
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
                                </b><br>Keterangan:<br><b>{{$modules->keterangan}}</b></div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Job</th>
                                    <th>Module</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($job as $jobs)
                                    <tr>
                                        <td>{{$jobs->user}}</td>
                                        <td>{{$jobs->nama_job}}</td>
                                        <td>{{$jobs->nama_module}}</td>
                                        <td>{{$jobs->keterangan}}</td>
                                        <td>
                                            <div class="btn-group">

                                                <a class="btn btn-info" href="/jobs/{{$jobs->id_job}}/edit">
                                                    <i class="fa fa-lg fa-edit">
                                                    </i>
                                                </a>
                                            </div>
                                        </td>
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