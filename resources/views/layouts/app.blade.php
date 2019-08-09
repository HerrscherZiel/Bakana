<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Timeline</title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/app.css')}}">
    
    <link rel="stylesheet" type="text/css" href="{{URL::asset('js/include/ui-1.10.0/ui-lightness/jquery-ui-1.10.0.custom.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{URL::asset('js/jquery.ui.timepicker.css')}}" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/main.css')}}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<body class="app sidebar-mini rtl">
<div id="app">
    <header class="app-header"><a class="app-header__logo" href="{{ url('/timelines') }}">Timeline</a>
      <!-- Sidebar toggle button-->
      <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <!-- <li><a class="app-nav__item" href="#" id="btnFullscreen"><i class="fa fa-user fa-lg"></i></a></li> -->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="{!! url('/userInfo') !!}"><i class="fa fa-user fa-lg"></i> Profile</a></li>
            <li><a class="dropdown-item" href="{!! url('/logout') !!} " onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-lg"></i> Logout</a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user">
        <div class="ml-4">
          <p class="app-sidebar__user-name">{{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}</p>
          <p class="app-sidebar__user-designation">{{{Auth::user()->email }}}</p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item {{ request()->is('home') ? 'active' : ''  }}"  href="{{ url('/timelines') }}"><i class="app-menu__icon fa fa-calendar"></i><span class="app-menu__label">Timeline</span></a></li>

        <li><a class="app-menu__item {{ request()->is('projects*','completedProject*', 'module/*') ? 'active' : ''  }}"  href="{{ url('/projects') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Project</span></a></li>

          @if(Auth::user()->hasRole('Project Manager'))
          <li><a class="app-menu__item {{ request()->is('modules*','completedModule*') ? 'active' : ''  }}" href="{{ url('/modules') }}"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Modul</span></a>
          </li>
          @endif

          @if(Auth::user()->hasRole('Project Manager'))
          <li><a class="app-menu__item {{ request()->is('job*','completedJob*') ? 'active' : ''  }}" href="{{ url('/jobs') }}"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Job</span></a></li>
          @endif

          @if(Auth::user()->hasRole('Project Manager'))
              <li><a class="app-menu__item {{ request()->is('users*') ? 'active' : ''  }}" href="{{ url('/users') }}"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">User</span></a>
          </li>
          @endif

          @if(Auth::user()->hasRole('Project Manager'))
          <li><a class="app-menu__item {{ request()->is('roles*') ? 'active' : ''  }}" href="{{ url('/roles') }}"><i class="app-menu__icon fa fa-user-secret"></i><span class="app-menu__label">Role</span></a>
          </li>
          @endif

        <li><a class="app-menu__item {{ request()->is('team*', 'teamprojects*', 'disbandedTeam*') ? 'active' : ''  }}" href="{{ url('/teamprojects') }}"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Team</span></a>
        </li>

          <li><a class="app-menu__item {{ request()->is('userInfo*','myCompletedProject*','change*') ? 'active' : ''  }}" href="{{ url('/userInfo') }}"><i class="app-menu__icon fa fa-info-circle"></i><span class="app-menu__label">User Info</span></a>
          </li>

        <li><a class="app-menu__item {{ request()->is('timesheetsAjax*') ? 'active' : ''  }}" href="{{ url('/timesheetsAjax') }}"><i class="app-menu__icon fa fa-calendar-plus-o"></i><span class="app-menu__label">Timesheet</span></a>
        </li>
      </ul>
    </aside>

        <main class="app-content">
          <div class="app-title">
            <h1><a href="javascript:history.back()"> <i class="fa fa-arrow-left mr-3"></i></a>{{ucwords(Session::get('title'))}}</h1>
          </div>
          <div class="mb-5">
            @yield('content')
          </div>
            <footer class="footer m-center" style="display: block; ">
              <span class="text-muted">Copyright  © 2019 <b>Mahasiswa Magang Universitas Gadjah Mada</b> - Yogyakarta, Indonesia.</span>
            </footer>
        </main>
    </div>
 <!-- Essential javascripts for application to work-->
<script src="{{URL::asset('js/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/jquery-3.4.1.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/include/jquery-1.9.0.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/jquery-ui.js')}}"></script>
<script src="{{URL::asset('js/popper.min.js')}}"></script>
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('js/main.js')}}"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{URL::asset('js/plugins/pace.min.js')}}"></script>
<!-- Page specific javascripts-->

  <script type="text/javascript" src="{{URL::asset('js/include/ui-1.10.0/jquery.ui.core.min.js')}}"></script>
  <script type="text/javascript" src="{{URL::asset('js/include/ui-1.10.0/jquery.ui.widget.min.js')}}"></script>
  <script type="text/javascript" src="{{URL::asset('js/include/ui-1.10.0/jquery.ui.tabs.min.js')}}"></script>
  <script type="text/javascript" src="{{URL::asset('js/include/ui-1.10.0/jquery.ui.position.min.js')}}"></script>
  <script type="text/javascript" src="{{URL::asset('js/jquery.ui.timepicker.js?v=0.3.3')}}"></script>
  <script type="text/javascript" src="{{URL::asset('js/list.min.js')}}"></script>
  <script type="text/javascript" src="{{URL::asset('js/plugins/select2.min.js')}}"></script>
  <script type="text/javascript" src="{{URL::asset('js/bootstrap-datepicker.js')}}"></script>
  <!-- delete -->
  <script type="text/javascript" src="{{URL::asset('js/plugins/bootstrap-notify.min.js')}}"></script>
  <script type="text/javascript" src="{{URL::asset('js/plugins/sweetalert.min.js')}}"></script>
  <script type="text/javascript">
    var options = {
      valueNames: [ 'name', 'status', 'sisa' ]
    };

    var userList = new List('projects', options);
  </script>
  <script type="text/javascript">
    $('#user_id').select2({
      placeholder: 'Pilih User',
      allowClear: true
    });
      $('button.delete-btn').on('click', function(e){
      event.preventDefault();
      var self = $(this);
      swal({
        title: "Anda yakin?",
        text: "Anda tidak akan bisa mengembalikannya lagi",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
      }, function(isConfirm) {
        if (isConfirm) {
          swal("Terhapus!", "Berhasil terhapus dari database.", "success");
         setTimeout(function() {
                  self.parents(".delete").submit();
              }, 500);
        } else {
          swal("Batal dihapus!", "Data aman di database.", "error");
        }
      });
    });
  </script>
  <!-- datepicker -->
  <script type="text/javascript">
    $(document).ready(function(){
  
    $("input[name='tgl_mulai']").datepicker({
        todayBtn:  1,
        autoclose: true,
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $("input[name='tgl_selesai']").datepicker('setStartDate', minDate);
    });
    
    $("input[name='tgl_selesai']").datepicker()
        .on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $("input[name='tgl_mulai']").datepicker('setEndDate', minDate);
        });

});
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
  
    $("input[name='tgl_mulai']").datepicker({
        todayBtn:  1,
        autoclose: true,
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $("input[name='deadline']").datepicker('setStartDate', minDate);
    });
    
    $("input[name='deadline']").datepicker()
        .on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $("input[name='tgl_mulai']").datepicker('setEndDate', minDate);
        });

});
  </script>
<script type="text/javascript">
  let today = new Date().toISOString().substr(0, 10);
document.querySelector("#date").value = today;
</script>
<script type="text/javascript">
  var date = new Date();
  date.setDate(date.getDate());
// timesheet
  $('#date').datepicker({ 
      endDate: date,
      autoclose: true,
      todayHighlight: true
  });

  // project
  $('#date1,#date2').datepicker({
  format: "yyyy-mm-dd",
  autoclose: true,
  todayHighlight: true
  });
  // modul, job
  $('#date3,#date4,#date5').datepicker({
  startDate: $("#startDate").val(),
  endDate: $("#endDate").val(),
  autoclose: true,
  todayHighlight: true
  });
</script>
<!-- Data table plugin-->
<script type="text/javascript" src="{{URL::asset('js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
<script type="text/javascript">$('#timesheet_table').DataTable({
  dom: 'Bfrtip',
            buttons: [
                 'excel', 'pdf', 'print'
            ],
            initComplete: function () {
            this.api().columns([0,1]).every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.header() ))
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        },
            "order": [[ 2, "desc" ]]
});</script>
<!-- Calendar-->
<script type="text/javascript" src="{{URL::asset('js/plugins/moment.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/jquery-ui.custom.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/fullcalendar.min.js')}}"></script>


<!-- Full Calendar -->
<script type="text/javascript">
  $(document).ready(function() {
  
    $('#external-events .fc-event').each(function() {
  
      // store data so the calendar knows to render an event upon drop
      $(this).data('event', {
        title: $.trim($(this).text()), // use the element's text as the event title
        stick: true // maintain when user navigates (see docs on the renderEvent method)
      });
  
      // make the event draggable using jQuery UI
      $(this).draggable({
        zIndex: 999,
        revert: true,      // will cause the event to go back to its
        revertDuration: 0  //  original position after the drag
      });
  
    });
  
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      editable: true
      
    });
  
  
  });
</script>

<script>
    $(document).ready(function(){

        $('#user_table').DataTable({
            processing: true,
            serverSide: true,
            dom: 'Bfrtip',
            buttons: [
                 'excel', 'pdf', 'print'
            ],
            initComplete: function () {
            this.api().columns([0]).every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.header() ))
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        },
            "order": [[ 1, "desc" ]],
            ajax:{
                url: "{{ route('timesheets.test') }}",
            },
            columns:[

                // {
                //     data: 'id_timesheets',
                //     name: 'id_timesheets'
                // },
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
            $('.modal-title').text("Add Time");
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
                    $('.modal-title').text("Edit Timesheet");
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
                    $('#ok_button').text('OK');
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

<script type="text/javascript">
    $('.input-daterange input').each(function() {
        $(this).datepicker('clearDates'); 
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#timepicker_start').timepicker({
            showLeadingZero: false,
            onSelect: tpStartSelect,
            maxTime: {
                hour: 17, minute: 30
            },
            showCloseButton: true
        });
        $('#timepicker_end').timepicker({
            
            showLeadingZero: false,
            onSelect: tpEndSelect,
            minTime: {
                hour: 8, minute: 0
            },
            showNowButton: true,
            defaultTime: '',  // removes the highlighted time for when the input is empty.
            showCloseButton: true
        });
    });

    // when start time change, update minimum for end timepicker
    function tpStartSelect( time, endTimePickerInst ) {
        $('#timepicker_end').timepicker('option', {
            minTime: {
                hour: endTimePickerInst.hours,
                minute: endTimePickerInst.minutes
            }
        });
    }

    // when end time change, update maximum for start timepicker
    function tpEndSelect( time, startTimePickerInst ) {
        $('#timepicker_start').timepicker('option', {
            maxTime: {
                hour: startTimePickerInst.hours,
                minute: startTimePickerInst.minutes
            }
        });
    }
    
</script>
<!-- Delete Alert -->
<!-- <script>
  $(".delete").on("submit", function(){
      return confirm("Are you sure want to delete?");
  });
</script> -->
<!-- Show more -->
<script type="text/javascript">
  $(".show-more a").on("click", function() {
    var $this = $(this); 
    var $content = $this.parent().prev("div.content");
    var linkText = $this.text().toUpperCase();    
    
    if(linkText === "SHOW MORE"){
        linkText = "Show less";
        $content.switchClass("hideContent", "showContent", 100);
    } else {
        linkText = "Show more";
        $content.switchClass("showContent", "hideContent", 100);
    };

    $this.text(linkText);
  });
</script>

<script type="text/javascript">
    function showTeam() {
        $(document).ready(function() {
            /*event.preventDefault();*/
            $("#add-error-bag").hide();
            $('#showModal').modal('show');
        });
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>
{{--<script>
    $('#showModal').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('table.user') }}",
        columns: [
            {data: 'DT_Row_Index', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action'}
        ]
    });
</script>--}}

</body>
</html>
