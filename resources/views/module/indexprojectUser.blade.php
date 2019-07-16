@extends('layouts.user')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th>Modul</th>
                            <th>Durasi</th>
                            <th>Status</th>
                            <th>Project</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($module as $modules)
                                <td>{{$modules->nama_module}}</td>
                                <td>{{$modules->waktu}}</td>
                                <td>@if ($modules->status === 1 )
                                        Ongoing
                                    @elseif($modules->status === 2 )
                                        Queue
                                    @elseif($modules->status === 3 )
                                        Pending
                                    @elseif($modules->status === 4 )
                                        Completed
                                    @endif</td></td>
                                <td>{{$modules->nama_project}}</td>
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
