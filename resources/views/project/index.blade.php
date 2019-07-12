@extends('layouts.app')

@section('content')
<a href="{{url('/projects/create')}}" class="btn btn-primary mb-3">Create Project</a>
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
                <button class="btn btn-primary" href="javascript:;" data-toggle="modal" onclick="deleteData({{$projects->id_project}})" data-target="#hapus" >
                    <i class="fa fa-lg fa-trash"></i>
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


<!-- Modal -->
<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="hapusTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="" id="deleteForm" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         @csrf
          @method('POST')
        Are you sure you want to delete this project ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger" onclick="formSubmit()">Delete</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
     function deleteData(id_project)
     {
         var id_project = id_project;
         var url = '{{ route('projects.destroy', $projects->id_project)}}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
  </script>

@endsection
