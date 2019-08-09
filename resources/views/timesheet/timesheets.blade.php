@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body table-responsive">
                <table class="table table-hover table-bordered" id="user_table">
                    <a name="create_record" id="create_record" class="btn btn-primary mb-3 mr-2" style="color: #FFF"> <i class="fa fa-plus"></i>Add Timesheet</a>
                    &nbsp;
                    <a href="{{url('/teamTimesheets')}}" class="btn btn-primary mb-3 mr-2" style="color: #FFF"> <i class="fa fa-plus"></i>Team Timesheet</a>
                    <thead>
                    <tr>
                        <th>Project</th>
                        <th>Tanggal</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
 
<!-- Modal -->
<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" >Add Timesheet</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <input type="hidden" name="id_timesheets" id="id_timesheets" class="form-control" />
                            <select class="form-control" name="project" id="project" required>
                                @foreach($usher as $ushers)
                                    <option value="{{$ushers->nama_project}}">{{$ushers->nama_project}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="date" data-provide="datepicker" class="form-control" name="tgl_timesheet" readonly="" required>
                        </div>
                        <div class="form-group input-group">
                            <input type="text" name="jam_mulai" id="timepicker_start" class="form-control" value="08:30" placeholder="Jam Mulai" required/>
                            <div class="mt-2 ml-3 mr-2">sampai</div>
                            <input type="text" name="jam_selesai" id="timepicker_end" class="form-control" value="17:00" placeholder="Jam Selesai" required/>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="4" name="keterangan_timesheet"  id="keterangan_timesheet" placeholder="Keterangan" required autofocus></textarea>
                        </div>
                </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="action" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</button>
                        <button name="action_button" id="action_button" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Confirmation</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection
