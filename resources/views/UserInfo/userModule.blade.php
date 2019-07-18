@extends('layouts.app')

@section('content')
    <div>
        <div>
    @foreach($project as $pro)

        {{$pro->nama_project}}

        @endforeach
        </div>
        <br>
        <hr>
        <br>
    @foreach($modulpro as $mod)
        <div>
            Module : {{$mod->nama_module}}<br>
            Status : @if ($mod->status === 1 )
                Ongoing
            @elseif($mod->status === 2 )
                Queue
            @elseif($mod->status === 3 )
                Pending
            @elseif($mod->status === 4 )
                Completed
            @endif <br>
            Job : {{$mod->nama_job}}<br>
            Keterangan : {{$mod->keterangan}}
        </div>
            <br>
            <hr>
            <br>
        @endforeach
    </div>


@endsection
