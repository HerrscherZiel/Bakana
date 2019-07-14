@extends('layouts.app')

@section('content')
<a href="{{url('/projects/create')}}" class="btn btn-primary mb-3">Create Project</a>
<div class="row">
  @foreach($project as $projects)
      <div class="col-md-6">
        <div class="tile">
          <div class="tile-title-w-btn">
            <h3 class="title">{{$projects->nama_project}}</h3>
              
          <div class="btn-group bs-component">
              <a class="btn btn-primary" href="/projects/{{$projects->id_project}}">
                  <i class="fa fa-lg fa-eye">
                  </i>
              </a>
              <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="/projects/{{$projects->id_project}}/edit">
                  <i class="fa fa-lg fa-edit">
                  </i>
              </a>
              <form class="delete" action="{{ route('projects.destroy', $projects->id_project)}}" method="post">
                <input type="hidden" name="_method" value="DELETE">
                @csrf
                @method('DELETE')
              <button  data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus" class="btn btn-primary" style="margin-left: -2px">
                  <i class="fa fa-lg fa-trash"></i>
              </button>
            </form>
             </div>
          </div>
          <div class="tile-body">
           <div class="row">
            <div class="col-md-6">
              <a>Project Code: <b>{{$projects->kode_project}}</b></a><br>
               <a>Status: <b>{{$projects->status}}</b></a>
             </div>
             <div class="col-md-6">
               <a>dari: {{$projects->tgl_mulai}}</a><br>
               <a>sampai: {{$projects->tgl_selesai}}</a>
             </div>
             <div class="col-md-12">
             <a>Keterangan: <br>{{$projects->ket}}</a>
             </div>
           </div>
          </div>
           <div class="tile-footer">
           <a href="/module/{{$projects->id_project}}" class="btn btn-primary">Show Modul</a>
          <a href="/team/{{$projects->id_project}}" class="btn btn-primary">Show Team</a>
        </div>
        </div>
      </div>
  @endforeach
</div>
@endsection
