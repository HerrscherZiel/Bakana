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

            <select class="form-control" name="title" required="" style="display: none">
                @foreach($project as $projects)

                    <option value="{{$projects->id_project}}"
                            @if($projects->id_project === $module->project_id)
                            selected 
                            {{$title = $projects->nama_project}}
                            {{$m = $projects->tgl_mulai}}
                            {{$n = $projects->tgl_selesai}}
                        @endif
                    >{{$projects->nama_project}}</option>
                @endforeach
            </select>

            <h3 class="tile-title mb-1">Project {{$title}}</h3>
            <h6 class="control-label text-muted">Timeline: {{date("d M Y", strtotime($m))}}  sampai  {{date("d M Y", strtotime($n))}}</h6>
            <form method="post" action="{{ route('module.updates', $module->id_module) }}">
                @method('PATCH')
                @csrf
                <div class="tile-body">
                    <div class="form-group">
                        <input type="hidden" value="{{csrf_token()}}" name="_token" />
                        <select style="display:none" class="form-control" name="project_id" required="">
                            <option value="" disabled>Select Project</option>
                            @foreach($project as $projects)
                                <option value="{{$projects->id_project}}"
                                        @if($projects->id_project === $module->project_id)
                                        selected
                                    @endif
                                >{{$projects->nama_project}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nama Modul</label>
                        <input class="form-control" type="text" name="nama_module" value="{{ $module->nama_module }}"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">User</label>
                        <select class="form-control" name="user" required="">
                            @foreach($user as $users)
                                <option value="{{$users->name}}"
                                        @if($users->name === $module->user)
                                        selected
                                    @endif
                                >{{$users->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group input-group">
                        <input type="hidden" id="startDate" name="startDate" value="{{$m}}">
                        <input type="hidden" id="endDate" name="endDate" value="{{$n}}">
                        <label class="control-label mt-2 mr-2">Tanggal Mulai</label>
                        <input id="date3" data-provide="datepicker" class="form-control" name="tgl_mulai" value="{{ $module->tgl_mulai }}" readonly="">
                        <label class="control-label mt-2 ml-5 mr-2">Tanggal Deadline</label>
                        <input id="date4" data-provide="datepicker" class="form-control" name="deadline" value="{{ $module->deadline }}" readonly="">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Target Selesai</label>
                        <input id="date5" data-provide="datepicker" class="form-control" name="tgl_user" value="{{ $module->tgl_user }}" readonly="">
                    </div>
                    <div class="form-group">
                        <input type="hidden" value="{{ $on = 1, $que = 2 , $pen = 3, $com = 4, $can =5}}"/>
                        <label class="control-label">Status</label>
                         <select class="form-control" name="status" required="">
                             <option disabled>Status</option>
                             <option value=1 @if($module->status === $on) selected
                                 @endif>Ongoing</option>
                             <option value=2 @if($module->status === $que) selected
                                 @endif>Queue</option>
                             <option value=3 @if($module->status === $pen) selected
                                 @endif>Pending</option>
                             <option value=4 @if($module->status === $com) selected
                                 @endif>Completed</option>
                             <option value=5 @if($module->status === $can) selected
                                 @endif>Canceled</option>
                         </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Keterangan</label>
                        <textarea class="form-control" rows="4" name="keterangan">{{ $module->keterangan }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="color" name="color" value="{{ $module->color }}">
                        <label class="control-label">Pilih warna untuk timeline</label>
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
