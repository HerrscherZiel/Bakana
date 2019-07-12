@extends('layouts.app')

@section('content')
<a href="{{url('/projects/create')}}" class="btn btn-primary mb-3">Create Project</a>
<div class="row">
     @foreach($project as $projects)
        <div class="col-md-6">
          <div class="tile">
            <div class="tile-title-w-btn">
              <h3 class="title">{{$projects->nama_project}}</h3>
                <a href="/module/{{$projects->id_project}}" class="btn btn-primary pull-right">Show Module</a>
                <br>
                <a href="/team/{{$projects->id_project}}" class="btn btn-primary pull-right">Show Team</a>
            <div class="btn-group">
                <a class="btn btn-primary" href="/projects/{{$projects->id_project}}">
                    <i class="fa fa-lg fa-eye">
                    </i>
                </a>
                {{--<a class="btn btn-primary" href="/projects/{{$projects->id_project}}">
                    <i class="fa fa-lg fa-eye">
                    </i>
                </a>--}}
                <a class="btn btn-primary" href="/projects/{{$projects->id_project}}/edit">
                    <i class="fa fa-lg fa-edit">
                    </i>
                </a>
                <form action="{{ route('projects.destroy', $projects->id_project)}}" method="post">
                    @csrf
                    @method('DELETE')

                <button class="btn btn-primary" type="submit">
                    <i class="fa fa-lg fa-trash">
                    </i>
                </button>
                    </form>

{{--                    <form action="{{ route('jobs.destroy', $jobs->id_job)}}" method="post">--}}
{{--                        @csrf--}}
{{--                        @method('DELETE')--}}
{{--                        <button class="btn btn-danger" type="submit">Delete</button>--}}
{{--                    </form>--}}


               </div>
            </div>
            <div class="tile-body">
             <ul>
                 <li>Tanggal Mulai: {{$projects->tgl_mulai}}</li>
                 <li>Tanggal Selesai: {{$projects->tgl_selesai}}</li>
                 <li>Keterangan: {{$projects->ket}}</li>
             </ul>
              
            </div>
          </div>
        </div>
    @endforeach
      </div>

@endsection
