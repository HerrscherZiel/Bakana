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

            <select class="form-control" name="tittle" required="" style="display: none">
                @foreach($project as $projects)

                    <option value="{{$projects->id_project}}"
                            @if($projects->id_project === $module->project_id)
                            selected {{$tittle = $projects->nama_project}}
                        @endif
                    >{{$projects->nama_project}}</option>
                @endforeach
            </select>

            <h3 class="tile-title">Project {{$tittle}}</h3>
            <form method="post" action="{{ route('modules.update', $module->id_module) }}">
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
                        {{--                        <label class="control-label">Nama Modul</label>--}}
                        <input class="form-control" type="hidden" name="nama_module" value="{{ $module->nama_module }}"/>
                    </div>
                    <div class="form-group">
                        {{--                        <label class="control-label">User</label>--}}
                        <select class="form-control" style="display: none" name="user" required="">
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
                        <input id="date1" type="hidden"class="form-control" name="tgl_mulai" value={{ $module->tgl_mulai }}>
                        {{--                        <div class="mt-1 ml-3 mr-3">to</div>--}}
                        <input id="date2"type="hidden" class="form-control" name="deadline" value={{ $module->deadline }}>
                    </div>
                    <div class="form-group input-group">
                        Target<br>
                        <input id="date1" class="form-control" name="tgl_user" value={{ $module->tgl_user }}>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Status</label>
                        <input class="form-control" type="text" name="status" value={{ $module->status }}>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Keterangan</label>
                        <textarea class="form-control" rows="4" name="keterangan">{{ $module->keterangan }}</textarea>
                    </div>
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                    <a class="btn btn-secondary" href="javascript:history.go(-1)"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
