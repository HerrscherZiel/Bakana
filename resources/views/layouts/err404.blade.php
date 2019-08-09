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
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/main.css')}}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<body class="app sidebar-mini rtl">
{{--@include('flash-message')--}}
<div id="app">
    <header class="app-header"><a class="app-header__logo" href="{{ url('/timelines') }}">Timeline</a>
        <!-- Sidebar toggle button-->
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">
            <li><a class="app-nav__item" href="{!! url('/logout') !!}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="text-decoration: none">Logout<i class="fa fa-sign-out fa-lg ml-2"></i></a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
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
            <li><a class="app-menu__item {{ request()->is('home') ? 'active' : ''  }}"  href="{{ url('/timelines') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Timeline</span></a></li>

            <li><a class="app-menu__item {{ request()->is('projects*','completedProject*') ? 'active' : ''  }}"  href="{{ url('/projects') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Project</span></a></li>

            @if(Auth::user()->hasRole('Project Manager'))
                <li><a class="app-menu__item {{ request()->is('modules*', 'module*','completedModule*') ? 'active' : ''  }}" href="{{ url('/modules') }}"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Modul</span></a>
                </li>
            @endif

            @if(Auth::user()->hasRole('Project Manager'))
                <li><a class="app-menu__item {{ request()->is('jobs*','completedJob*') ? 'active' : ''  }}" href="{{ url('/jobs') }}"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Job</span></a></li>
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

            <li><a class="app-menu__item {{ request()->is('userInfo*') ? 'active' : ''  }}" href="{{ url('/userInfo') }}"><i class="app-menu__icon fa fa-info-circle"></i><span class="app-menu__label">User Info</span></a>
            </li>

            <li><a class="app-menu__item {{ request()->is('timesheet*') ? 'active' : ''  }}" href="{{ url('/timesheets') }}"><i class="app-menu__icon fa fa-calendar-plus-o"></i><span class="app-menu__label">Timesheet</span></a>
            </li>

        </ul>
    </aside>

    <main class="app-content">
        <div class="app-title">
            <h1><a href="{{URL::previous()}}"> <i class="fa fa-arrow-left mr-3"></i></a>{{ucwords(Session::get('title'))}}</h1>
        </div>

        <div class="page-error tile">
            <h1><i class="fa fa-exclamation-circle mr-3"></i>404</h1>
            <br>
            <h2><p>Page not Found</p></h2>
            <br>
            <p><a class="btn btn-primary mr-3" href="{{url('/home')}}">Go to Home</a>
                <a class="btn btn-secondary ml-3" href="javascript:window.history.back();">Go Back</a></p>
        </div>

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
<!-- Calendar-->
<script type="text/javascript" src="{{URL::asset('js/plugins/moment.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/jquery-ui.custom.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/fullcalendar.min.js')}}"></script>


<script type="text/javascript">
    $('.input-daterange input').each(function() {
        $(this).datepicker('clearDates');
    });
</script>
<script type="text/javascript">
    $('#sl').click(function(){
        $('#tl').loadingBtn();
        $('#tb').loadingBtn({ text : "Signing In"});
    });

    $('#el').click(function(){
        $('#tl').loadingBtnComplete();
        $('#tb').loadingBtnComplete({ html : "Sign In"});
    });

    $('#demoSelect').select2();
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
                hour: 8, minute: 00
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
<!-- autorefresh -->
{{--<script>--}}
{{--if(location.search.indexOf('php') < 0){--}}
{{--  var hash = window.location.hash;--}}
{{--  var loc = window.location.href.replace(hash, '');--}}
{{--  loc += (loc.indexOf('?') < 0? '?' : '&') + 'php';--}}
{{--  // SET THE ONE TIME AUTOMATIC PAGE RELOAD TIME TO 5000 MILISECONDS (5 SECONDS):--}}
{{--  setTimeout(function(){window.location.href = loc + hash;}, 5);--}}
{{--}--}}
{{--</script>--}}
<!-- Google analytics script-->
<script type="text/javascript">
    if(document.location.hostname == 'pratikborsadiya.in') {
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-72504830-1', 'auto');
        ga('send', 'pageview');
    }
</script>
</body>
</html>
