@extends('layouts.app')

@section('content')
    <div>
    @foreach($modulpro as $mod)
        <div>
            User : {{$mod->user}} <br>
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
