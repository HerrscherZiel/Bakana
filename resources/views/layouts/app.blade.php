<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Timeline</title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('docs/css/main.css')}}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="app sidebar-mini rtl" id="fullscreen">
    <div id="app">
    <header class="app-header"><a class="app-header__logo" href="{{ url('/home') }}">Timeline</a>
      <!-- Sidebar toggle button-->
      <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <li>
          <a class="app-nav__item" href="#" onclick="openFullscreen();"><i class="fa fa-expand fa-lg"></i> 
          </a>
        </li>
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
          <p class="app-sidebar__user-name">Mr. Z</p>
          <p class="app-sidebar__user-designation">Project Manager</p>
        </div>
      </div>
      <ul class="app-menu active">
        <li><a class="app-menu__item active"  href="{{ url('/home') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Timeline</span></a></li>

        <li><a class="app-menu__item "  href="{{ url('/projects') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Project</span></a></li>

          @if(Auth::user()->hasRole('Project Manager'))
          <li><a class="app-menu__item" href="{{ url('/modules') }}"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Modul</span></a>
          </li>
          @endif

          @if(Auth::user()->hasRole('Project Manager'))
          <li><a class="app-menu__item" href="{{ url('/jobs') }}"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Job</span></a></li>
          @endif

          @if(Auth::user()->hasRole('Project Manager'))
              <li><a class="app-menu__item" href="{{ url('/users') }}"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">User</span></a>
          </li>
          @endif

          @if(Auth::user()->hasRole('Project Manager'))
          <li><a class="app-menu__item" href="{{ url('/roles') }}"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Role</span></a>
          </li>
          @endif

        <li><a class="app-menu__item" href="{{ url('/teamprojects') }}"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Team</span></a>
        </li>

          <li><a class="app-menu__item" href="{{ url('/userInfo') }}"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">User Info</span></a>
          </li>

        <li><a class="app-menu__item" href="{{ url('/timesheets') }}"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Timesheet</span></a>
        </li>

      </ul>
    </aside>

        <main class="app-content">
          <div class="app-title">
            <h1><a href="javascript:history.go(-1)"> <i class="fa fa-arrow-left mr-3"></i></a>{{ucwords(Session::get('title'))}}</h1>
        </div>
            @yield('content')
        </main>
    </div>
 <!-- Essential javascripts for application to work-->
<script src="{{URL::asset('docs/js/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('docs/js/jquery-3.4.1.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('docs/js/jquery-ui.js')}}"></script>
<script src="{{URL::asset('docs/js/popper.min.js')}}"></script>
<script src="{{URL::asset('docs/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('docs/js/main.js')}}"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{URL::asset('docs/js/plugins/pace.min.js')}}"></script>
<!-- Page specific javascripts-->
<script type="text/javascript" src="{{URL::asset('docs/js/plugins/chart.js')}}"></script>
<!-- <script type="text/javascript" src="{{URL::asset('docs/js/plugins/bootstrap-datepicker.min.js')}}"></script> -->
<script type="text/javascript" src="{{URL::asset('docs/js/plugins/select2.min.js')}}"></script>
  <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
  <script type="text/javascript" src="{{URL::asset('docs/js/bootstrap-datepicker.js')}}"></script>
  <!-- delete -->
<script type="text/javascript" src="{{URL::asset('docs/js/plugins/bootstrap-notify.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('docs/js/plugins/sweetalert.min.js')}}"></script>
    <script type="text/javascript">
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
            swal("Batal dihapus!", "Item aman di database.", "error");
          }
        });
      });
    </script>

<script type="text/javascript">
  var date = new Date();
  date.setDate(date.getDate());

  $('#date').datepicker({ 
      endDate: date,
      autoclose: true,
      todayHighlight: true
  });
  $('#date1,#date2').datepicker({
  format: "yyyy-mm-dd",
  autoclose: true,
  todayHighlight: true
  });
</script>
<!-- Data table plugin-->
<script type="text/javascript" src="{{URL::asset('docs/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('docs/js/plugins/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
<!-- Calendar-->
<script type="text/javascript" src="{{URL::asset('docs/js/plugins/moment.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('docs/js/plugins/jquery-ui.custom.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('docs/js/plugins/fullcalendar.min.js')}}"></script>
 <!-- DayPilot library -->
<script src="{{URL::asset('js/daypilot-all.min.js')}}"></script> 
<script>
  var dp = new DayPilot.Scheduler("dp", {
    timeHeaders: [{"groupBy":"Month"},{"groupBy":"Day","format":"d"}],
    scale: "Day",
    days: DayPilot.Date.today().daysInYear(),
    startDate: DayPilot.Date.today().firstDayOfYear(),
    showNonBusiness: false,
    timeRangeSelectedHandling: "Enabled",
    onTimeRangeSelected: function (args) {
      var dp = this;
      DayPilot.Modal.prompt("Create a new timeline:", "Timeline 1").then(function(modal) {
        dp.clearSelection();
        if (!modal.result) { return; }
        dp.events.add(new DayPilot.Event({
          start: args.start,
          end: args.end,
          id: DayPilot.guid(),
          resource: args.resource,
          text: modal.result
        }));
      });
    },
    eventMoveHandling: "Update",
    onEventMoved: function (args) {
      this.message("Timeline moved: " + args.e.text());
    },
    eventResizeHandling: "Update",
    onEventResized: function (args) {
      this.message("Timeline resized: " + args.e.text());
    },
    eventDeleteHandling: "Update",
    onEventDeleted: function (args) {
      this.message("Timeline deleted: " + args.e.text());
    },
    eventClickHandling: "Disabled",
    eventHoverHandling: "Bubble",
    bubble: new DayPilot.Bubble({
      onLoad: function(args) {
        // if event object doesn't specify "bubbleHtml" property 
        // this onLoad handler will be called to provide the bubble HTML
        args.html = "Timeline details";
      }
    }),
    treeEnabled: true,
  });
  dp.resources = [
    {name: "Resource 1", id: "R1"},
    {name: "Resource 2", id: "R2"}
  ];
  dp.events.list = [];
  dp.init();
</script>
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
      editable: true,
      droppable: true, // this allows things to be dropped onto the calendar
      drop: function() {
        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove();
        }
      }
    });
  
  
  });
</script>
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
  var data = {
    labels: ["Januari", "Februari", "Maret", "April", "Mei"],
    datasets: [
        {
            label: "My First timeline",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [65, 59, 80, 81, 56]
        },
        {
            label: "My Second timeline",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [28, 48, 40, 19, 86]
        }
    ]
  };
  var pdata = [
    {
        value: 300,
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "Complete"
    },
    {
        value: 50,
        color:"#F7464A",
        highlight: "#FF5A5E",
        label: "In-Progress"
    }
  ]
  
  var ctxl = $("#lineChartDemo").get(0).getContext("2d");
  var lineChart = new Chart(ctxl).Line(data);
  
  var ctxp = $("#pieChartDemo").get(0).getContext("2d");
  var pieChart = new Chart(ctxp).Pie(pdata);
</script>
<!-- Delete Alert -->
<!-- <script>
  $(".delete").on("submit", function(){
      return confirm("Are you sure want to delete?");
  });
</script> -->

<!-- Fullscreen -->
<script>
  var elem = document.getElementById("fullscreen");
  function openFullscreen() {
    if (elem.requestFullscreen) {
      elem.requestFullscreen();
    } else if (elem.mozRequestFullScreen) { /* Firefox */
      elem.mozRequestFullScreen();
    } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
      elem.webkitRequestFullscreen();
    } else if (elem.msRequestFullscreen) { /* IE/Edge */
      elem.msRequestFullscreen();
    }
  }
</script>
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
