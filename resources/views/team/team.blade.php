@extends('layouts.ts')
@section('content')
<div class="row">
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
            <h3 class="tile-title">Project {{$project->nama_project}}</h3>
            @if(Auth::user()->hasRole('Project Manager'))
            <div align="right">
                <a name="create_team" id="create_team" class="btn btn-primary mb-3" style="color: #FFF"><i class="fa fa-plus"></i> Add to Team</a>
            </div>
            @endif
            <div class="tile-body table-responsive">
                <table class="table table-hover table-bordered" id="team_table">
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Role</th>
        {{--                @if(Auth::user()->hasRole('Project Manager'))--}}
                            <th style="width: 10%">Action</th>
        {{--                @endif--}}
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


<div id="formModa" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-titl">Add to Team</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <span id="form_resul"></span>
                <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                    <div class="form-group">
                            <input type="hidden" name="id_team_projects" id="id_team_projects" class="form-control" />
                            <select style="display: none;" class="form-control" name="project_id" id="project_id" required="">
                                <option value="{{$project->id_project}}" selected>{{$project->nama_project}}</option>
                            </select>
                        <select class="form-control" name="user_id" id="user_id" style="width: 100%" required>
                            @foreach($user as $users)
                                <option value="{{$users->id}}">{{$users->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                     <div class="modal-footer">
                        <input type="hidden" name="actio" id="actio" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</button>
                        <button name="action_butto" id="action_butto" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="confirmModa" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-titl">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_butto" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

@endsection
