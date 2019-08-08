<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 5.8 - DataTables Server Side Processing using Ajax</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <br />
    <h3 align="center">Laravel 5.8 Ajax Crud Tutorial - Delete or Remove Data</h3>
    <br />
    <div align="right">
        <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
    </div>
    <br />
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="user_table">
            <thead>
            <tr>
                <th width="10%">id</th>
                <th width="35%">Project Name</th>
                <th width="35%">tgl</th>
                <th width="35%">jam mulai</th>
                <th width="35%">jam selesai </th>
                <th width="35%">keterangan timesheet</th>
{{--                <th width="35%">User </th>--}}
                <th width="30%">Action</th>
            </tr>
            </thead>
        </table>
    </div>
    <br />
    <br />
</div>
</body>
</html>

<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Record</h4>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-4" >ID timesheet</label>
                        <div class="col-md-8">
                            <input type="hidden" name="id_timesheets" id="id_timesheets" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4">Project </label>
                        <select class="form-control" id="test" required>
                            @foreach($usher as $ushers)
                                <option name="project" id="project" value="{{$aa = $ushers->nama_project}}">
                                            {{$ushers->nama_project}}
                                    </option>
                            @endforeach

{{--                                <div class="col-md-8">--}}
{{--                                    <input type="hidden"  id="project" value="test" class="form-control" />--}}
{{--                                </div>--}}

                        </select>

                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4">Tgl Timesheet </label>
                        <div class="col-md-8">
                            <input type="date" name="tgl_timesheet" id="tgl_timesheet" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4">Jam Mulai </label>
                        <div class="col-md-8">
                            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4">Jam Lesai </label>
                        <div class="col-md-8">
                            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" rows="4" name="keterangan_timesheet"  id="keterangan_timesheet" placeholder="Keterangan" required autofocus></textarea>
                    </div>



                    <br />
                    <div class="form-group" align="center">
                        <input type="hidden" name="action" id="action" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmation</h2>
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


<script>
    $(document).ready(function(){

        $('#user_table').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "{{ route('timesheets.test') }}",
            },
            columns:[

                {
                    data: 'id_timesheets',
                    name: 'id_timesheets'
                },
                {
                    data: 'project',
                    name: 'project'
                },
                {
                    data: 'tgl_timesheet',
                    name: 'tgl_timesheet'
                },
                {
                    data: 'jam_mulai',
                    name: 'jam_mulai'
                },
                {
                    data: 'jam_selesai',
                    name: 'jam_selesai'
                },
                {
                    data: 'keterangan_timesheet',
                    name: 'keterangan_timesheet'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
        });

        $('#create_record').click(function(){
            $('.modal-title').text("Add New Record");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#formModal').modal('show');
        });

        $('#sample_form').on('submit', function(event){
            event.preventDefault();
            if($('#action').val() == 'Add')
            {
                $.ajax({
                    url:"{{ route('timesheets.store') }}",
                    method:"POST",
                    data: new FormData(this),
                    contentType: false,
                    cache:false,
                    processData: false,
                    dataType:"json",
                    success:function(data)
                    {
                        var html = '';
                        if(data.errors)
                        {
                            html = '<div class="alert alert-danger">';
                            for(var count = 0; count < data.errors.length; count++)
                            {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if(data.success)
                        {
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $('#sample_form')[0].reset();
                            $('#user_table').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                    }
                })
            }

            if($('#action').val() == "Edit")
            {
                $.ajax({
                    url:"{{ route('timesheetsAjax.update') }}",
                    method:"POST",
                    data:new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType:"json",
                    success:function(data)
                    {
                        var html = '';
                        if(data.errors)
                        {
                            html = '<div class="alert alert-danger">';
                            for(var count = 0; count < data.errors.length; count++)
                            {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if(data.success)
                        {
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $('#sample_form')[0].reset();
                            // $('#store_image').html('');
                            $('#user_table').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                    }
                });
            }
        });

        $(document).on('click', '.edit', function(){
            var id = $(this).attr('id');
            console.log(id);
            $('#form_result').html('');
            $.ajax({
                url:"/timesheetsAjax/"+id+"/edit",
                dataType:"json",
                success:function(html){
                    $('#id_timesheets').val(html.data.id_timesheets);
                    $('#project').val(html.data.project);
                    $('#tgl_timesheet').val(html.data.tgl_timesheet);
                    $('#jam_mulai').val(html.data.jam_mulai);
                    $('#jam_selesai').val(html.data.jam_selesai);
                    $('#keterangan_timesheet').val(html.data.keterangan_timesheet);
                    $('#hidden_id').val(html.data.id_timesheets);
                    $('.modal-title').text("Edit New Record");
                    $('#action_button').val("Edit");
                    $('#action').val("Edit");
                    $('#formModal').modal('show');
                }
            })
        });

        var user_id;

        $(document).on('click', '.delete', function(){
            id_timesheets = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function(){
            $.ajax({
                url:"timesheetsAjax/destroy/"+id_timesheets,
                beforeSend:function(){
                    $('#ok_button').text('Deleting...');
                },
                success:function(data)
                {
                    setTimeout(function(){
                        $('#confirmModal').modal('hide');
                        $('#user_table').DataTable().ajax.reload();
                    }, 2000);
                }
            })
        });

    });
</script>
