@extends('layouts.app')

@section('content')
    <div class="col-md-12">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <input type="hidden" value="{{ $on = 1, $que = 2 , $pen = 3, $com = 4, $can =5}}"/>



    <div class="tile">
    <h3 class="tile-title">Edit Project</h3>
    <form method="post" action="{{ route('projects.update', $project->id_project) }}">
        @method('PATCH')
                @csrf
<div class="tile-body">
            <div class="form-group">
                <label class="control-label">Project Code</label>
                <input type="hidden" value="{{csrf_token()}}" name="_token" />
                <input class="form-control" name="kode_project" type="text" value='{{ $project->kode_project }}'/>
            </div>
            <div class="form-group">
                <label class="control-label">Nama Project</label>
              <input class="form-control" type="text" name="nama_project" value='{{ $project->nama_project }}' />
            </div>
            <div class="form-group input-group ">
                <label class="control-label mt-2 mr-2">Tanggal Mulai</label>
                <input id="date1" readonly="" class="form-control" name="tgl_mulai" value="{{ $project->tgl_mulai }}" readonly="">
                <label class="control-label mt-2 ml-5 mr-2">Tanggal Selesai</label>
                <input id="date2" readonly="" class="form-control" name="tgl_selesai" value="{{ $project->tgl_selesai }}" readonly="">
            </div>


            <div class="form-group">
                <label class="control-label">Status</label>
                 <select class="form-control" name="status" required="">
                     <option disabled>Status</option>
                     <option value=1 @if($project->status === $on) selected
                         @endif>Ongoing</option>
                     <option value=2 @if($project->status === $que) selected
                         @endif>Queue</option>
                     <option value=3 @if($project->status === $pen) selected
                         @endif>Pending</option>
                     <option value=4 @if($project->status === $com) selected
                         @endif>Completed</option>
                     <option value=5 @if($project->status === $can) selected
                         @endif>Canceled</option>
                 </select>
            </div>

            <div class="form-group">
                <label class="control-label">Keterangan</label>
              <textarea class="form-control" rows="4" name="ket">{{ $project->ket }}</textarea>
            </div>

</div>
        <div class="tile-footer">
          <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
          <a class="btn btn-secondary" href="{{URL::previous()}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
        </div>
    </form>
  </div>
</div>

@endsection
