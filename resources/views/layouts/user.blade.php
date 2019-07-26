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
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/main.css')}}">

    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="{{URL::asset('docs/css/mhfullcalendar.min.css')}}"/> -->
</head>
<body class="app sidebar-mini rtl">
<div id="app">
    <header class="app-header"><a class="app-header__logo" href="{{ url('/home') }}">Timeline</a>
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
        <li><a class="app-menu__item {{ request()->is('home*','timelines*') ? 'active' : ''  }}"  href="{{ url('/timelines') }}"><i class="app-menu__icon fa fa-calendar"></i><span class="app-menu__label">Timeline</span></a></li>

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

          <li><a class="app-menu__item {{ request()->is('userInfo*','myCompletedProject*') ? 'active' : ''  }}" href="{{ url('/userInfo') }}"><i class="app-menu__icon fa fa-info-circle"></i><span class="app-menu__label">User Info</span></a>
          </li>

        <li><a class="app-menu__item {{ request()->is('timesheets*') ? 'active' : ''  }}" href="{{ url('/timesheets') }}"><i class="app-menu__icon fa fa-calendar-plus-o"></i><span class="app-menu__label">Timesheet</span></a>
        </li>
      </ul>
    </aside>

        <main class="app-content">
          <div class="app-title">
            <h1><a href="javascript:history.back()"> <i class="fa fa-arrow-left mr-3"></i></a>{{ucwords(Session::get('title'))}}</h1>
        </div>
            @yield('content')
        </main>
    </div>

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

</body>
</html>
