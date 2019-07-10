@extends('layouts.app')

@section('content')
<a href="{{url('/projects/create')}}" class="btn btn-success mb-3">Create Project</a>
<div class="row">
     @foreach($project as $projects)
        <div class="col-md-6">
          <div class="tile">
            <div class="tile-title-w-btn">
              <h3 class="title">{{$projects->nama_project}}</h3>
            <div class="btn-group">
                <a class="btn btn-primary" href="/projects/{{$projects->id_project}}">
                    <i class="fa fa-lg fa-eye">
                    </i>
                </a>
                <a class="btn btn-primary" href="/projects/{{$projects->id_project}}/edit">
                    <i class="fa fa-lg fa-edit">
                    </i>
                </a>
                <button class="btn btn-primary" >
                    <form action="{{ route('projects.destroy', $projects->id_project)}}" method="post">
                    @csrf
                    @method('DELETE')
                        <i class="fa fa-lg fa-trash">
                        </i>
                    </form>
                </button>
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
