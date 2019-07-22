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
    <link rel="stylesheet" type="text/css" href="{{URL::asset('docs/css/main.css')}}">

    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    {{--<link rel="stylesheet" type="text/css" href="{{URL::asset('docs/css/fullcalendar.min.css')}}">--}}
</head>
<body class="app sidebar-mini rtl" id="fullscreen">
{{--@include('flash-message')--}}
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
          <p class="app-sidebar__user-name">{{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}</p>
          <p class="app-sidebar__user-designation">{{{Auth::user()->email }}}</p>
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
            <h1><a href="javascript:history.go(-3)"> <i class="fa fa-arrow-left mr-3"></i></a>{{ucwords(Session::get('title'))}}</h1>
        </div>
            @yield('content')
        </main>
    </div>
 <!-- Essential javascripts for application to work-->
<script type="text/javascript" src="{{URL::asset('docs/js/jquery-3.4.1.js')}}"></script>
{!! $calendar->script() !!}
<!-- Calendar-->
<script type="text/javascript" src="{{URL::asset('docs/js/plugins/moment.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('docs/js/plugins/jquery-ui.custom.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('docs/js/plugins/fullcalendar.min.js')}}"></script>
<script src="{{URL::asset('docs/js/main.js')}}"></script>
</body>
</html>
