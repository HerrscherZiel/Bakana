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
        <h3>Project : {{$project->nama_project}}</h3>
    <br />
                    @if(Auth::user()->hasRole('Project Manager'))
    <div align="right">
        <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
    </div>
                    @endif

    <br />
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="user_table">
            <thead>
            <tr>
{{--                <th width="10%">id</th>--}}
{{--                <th>Project</th>--}}
                <th>User</th>
                <th>Role</th>
{{--                @if(Auth::user()->hasRole('Project Manager'))--}}
                    <th style="width: 10%">Action</th>
{{--                @endif--}}
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
                            <input type="hidden" name="id_team_projects" id="id_team_projects" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4">Project </label>

                        <div class="form-group">
                            <div class="col-md-8">
                                <select style="display: none;" class="form-control" name="project_id" id="project_id" required="">
                                    <option value="{{$project->id_project}}" selected>{{$project->nama_project}}</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4">Project </label>
                        <select class="form-control" name="user_id" id="user_id" required>
                            @foreach($user as $users)
                                <option value="{{$users->id}}">{{$users->name}}</option>
                            @endforeach
                        </select>
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
                url: "{{ route('team.ajax', ['id' => $project->id_project] ) }}",
            },

            columns:[

                // {
                //     data: 'id_team_projects',
                //     name: 'id_team_projects'
                // },
                // {
                //     data: 'nama_project',
                //     name: 'project_id',
                // },
                {
                    data: 'name',
                    name: 'user_id'
                },
                {
                    data: 'nama_role',
                    name: 'user_id'
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
                    url:"{{ route('teamAjax.store', ['id' => $project->id_project]) }}) }}",
                    // url:"/teamAjax/"+id,
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
                    url:"{{ route('teamAjax.update') }}",
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
                url:"/teamAjax/"+id+"/edit",
                dataType:"json",
                success:function(html){
                    $('#id_team_projects').val(html.data.id_team_projects);
                    $('#project_id').val(html.data.project_id);
                    $('#user_id').val(html.data.user_id);
                    $('#hidden_id').val(html.data.id_team_projects);
                    $('.modal-title').text("Edit New Record");
                    $('#action_button').val("Edit");
                    $('#action').val("Edit");
                    $('#formModal').modal('show');
                }
            })
        });

        var user_id;

        $(document).on('click', '.delete', function(){
            id_team_projects = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function(){
            $.ajax({
                url:"/teamAjax/destroy/"+id_team_projects,
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
