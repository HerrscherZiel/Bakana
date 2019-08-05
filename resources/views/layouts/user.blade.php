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
</head>
<body class="app sidebar-mini rtl">
<div id="app">
    <header class="app-header"><a class="app-header__logo" href="{{ url('/home') }}">Timeline</a>
      <!-- Sidebar toggle button-->
      <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
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
        <div class="mb-5">
            @yield('content')
          </div>
          <footer class="footer m-center" style="display: block;">
            <span class="text-muted">Copyright  © 2019 <b>Mahasiswa Magang Universitas Gadjah Mada</b> - Yogyakarta, Indonesia.</span>
          </footer>
        </main>
    </div>

</body>
</html>
