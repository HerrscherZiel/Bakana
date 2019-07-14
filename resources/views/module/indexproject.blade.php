@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
                <a href="{{url('/modules/create')}}" class="btn btn-primary">Create Module</a>
            <tr>
                <td>ID</td>
                <td>Module</td>
                <td>Waktu</td>
                <td>Status</td>
                <td>Project Name</td>
                <td>Keterangan</td>
                <td>Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($module as $modules)
                <tr>
                    <td>{{$modules->id_module}}</td>
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
                        @endif</td>
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

                                <form action="{{ route('modules.destroy', $modules->id_module)}}" method="post">
                                @csrf
                                @method('DELETE')
                                    <button class="btn btn-danger" type="submit">
                                    <i class="fa fa-lg fa-trash">
                                    </i>
                                    </button>
                                </form>

                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
@endsection
