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
        </div><br />
    @endif
     <div class="tile">
        <h3 class="tile-title mb-1">Project {{$project->nama_project}}</h3>
        <h6 class="control-label text-muted">Timeline: {{date("d-m-Y", strtotime($project->tgl_mulai))}}  sampai  {{date("d-m-Y", strtotime($project->tgl_selesai))}}</h6>
        <form method="post" action="{{url('/module/creates/$project->id_project')}}">
            <div class="tile-body">
                <div class="form-group">
                    <input type="hidden" value="{{csrf_token()}}" name="_token" />
                    <select style="display: none" class="form-control" name="project_id">
                        <option value="{{$project->id_project}}" selected>{{$project->nama_project}}</option>
                    </select>
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" name="nama_module" placeholder="Nama Modul">
                </div>
                <div class="form-group">
                    <select id="user_id" class="form-control" name="user" required="">
                        @foreach($mod as $mods)
                            <option value="{{$mods->name}}">{{$mods->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group input-group">
                    <input type="hidden" id="startDate" name="startDate" value="{{$project->tgl_mulai}}">
                    <input type="hidden" id="endDate" name="endDate" value="{{$project->tgl_selesai}}">
                    <input id="date3" data-provide="datepicker" class="form-control" name="tgl_mulai" placeholder="Tanggal Mulai" readonly="">
                    <div class="mt-1 ml-3 mr-3">to</div>
                    <input id="date4" data-provide="datepicker" class="form-control" name="deadline" placeholder="Tanggal Deadline" readonly="">
                </div>
                <div class="form-group input-group">
                    <input id="date5" data-provide="datepicker" class="form-control" name="tgl_user" placeholder="Target Selesai" readonly="">
                </div>
                <div class="form-group">
                <select class="form-control" name="status" required="">
                    <option disabled>Select Project</option>
                    <option value=1>Ongoing</option>
                    <option value=2>Queue</option>
                </select>
            </div>
                <div class="form-group">
                  <textarea class="form-control" rows="4" name="keterangan" placeholder="Keterangan"></textarea>
                </div>
                <div class="form-group">
                    <input type="color" name="color" value="#009688">
                    <label class="control-label">Pilih warna untuk timeline</label>
                </div>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Create</button>
              <a class="btn btn-secondary" href="{{URL::previous()}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
        </form>
      </div>
</div>

@endsection
