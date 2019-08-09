@extends('layouts.app')

@section('content')

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body table-responsive">
                    <table class="table table-hover table-bordered" id="PMTable">
                        <a href="{{url('/timesheets/create')}}" class="btn btn-primary mb-3 mr-2"> <i class="fa fa-plus"></i>Add Timesheet</a>


                        <a href="{{url('/timesheetss')}}" class="btn btn-primary mb-3">My Timesheet</a>
                        <thead>
                        <div class="form-group">
                            <label class="control-label col-md-4">Project </label>
                            <select class="form-control" name="project" id="project" required>
                                @foreach($project as $projects)
                                    <option value="{{$projects->id_project}}" selected="selected">{{$projects->nama_project}}</option>
                                @endforeach
                            </select>
                        </div>
                        <tr>
                            <th>User</th>
                            <th>Project</th>
                            <th>Tanggal</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Total Waktu</th>
                            <th>Keterangan</th>
                            @if(!Auth::user()->hasRole('Project Manager'))
                        </tr>
                        @endif
                        @if(Auth::user()->hasRole('Project Manager'))
                            <th>Action</th>
                            @endif
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($timesheetView as $timesheets)
                                <td>{{$timesheets->name}}</td>
                                <td>{{$timesheets->project}}</td>
                                <td>{{date("d M Y", strtotime($timesheets->tgl_timesheet))}}</td>
                                <td>{{date("H:i", strtotime($mulai = $timesheets->jam_mulai))}}</td>
                                <td>{{date("H:i", strtotime($selesai = $timesheets->jam_selesai))}}</td>
                                <td>{{$total = (strtotime($selesai) - strtotime($mulai))/60 }} menit</td>
                                <td>{{$timesheets->keterangan_timesheet}}</td>
                                @if(Auth::user()->hasRole('Project Manager'))
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-info" href="/timesheets/{{$timesheets->id_timesheets}}/edit">
                                                <i class="fa fa-lg fa-edit">
                                                </i>
                                            </a>
                                            <form class="delete" action="{{ route('timesheets.destroy', $timesheets->id_timesheets)}}" method="post">
                                                <input type="hidden" name="_method" value="DELETE">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger delete-btn" type="submit" style="margin-left: -2px">
                                                    <i class="fa fa-lg fa-trash">
                                                    </i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

{{--@push('scripts')
    <script>
        $(function() {
            $('#PMTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('timesheets.pm') !!}',
                columns: [
                    { data: 'id_timesheets', name: 'id_timesheets' },
                    { data: 'project', name: 'project' },
                    { data: 'tgl_timesheet', name: 'tgl_timesheet' },
                    { data: 'jam_mulai', name: 'jam_mulai' },
                    { data: 'jam_selesai', name: 'jam_selesai' },
                    { data: 'keterangan_timesheet', name: 'keterangan_timesheet' },
                    { data: 'action', name: 'action', orderable: false }
                ]
            });
        });

        $('#project').change(function(event){
        // $(document).on('change', '#project', function(){
            var query = $(this).find(":selected").val();

            $.ajax({
                url:"{{ route('timesheets.view') }}",
                method:'GET',
                // data:{query:query},
                dataType:'json',
                success:function(response)
                {
                    console.log(data);
                    $('#PMTable').DataTable(data).ajax.reload();
                    $('#PMTable').html(data);
                }
            })
        });

        /*$('#project').change(function(event){
            event.preventDefault();

            var Id = $(this).find(":selected").val();
            var DataString = Id;

                $.ajax({
                    url:"",
                    method:"GET",
                    data: DataString,
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
                            $('#PMTable').DataTable().ajax.reload();
                            // $("#PMTable").html(data);
                        }
                    }
                })
        });*/
    </script>
@endpush--}}
