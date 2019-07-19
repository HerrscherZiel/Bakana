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
</head>
<body class="app sidebar-mini rtl" id="fullscreen">
<div id="app">
    <header class="app-header"><a class="app-header__logo" href="{{ url('/home') }}">Timeline</a>
        <!-- Sidebar toggle button-->
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">
            <li>
                <a class="app-nav__item" onclick="openFullscreen();"><i class="fa fa-expand-arrows fa-lg"></i>
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
        <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
            <div>
                <p class="app-sidebar__user-name">Mr. Z</p>
                <p class="app-sidebar__user-designation">Project Manager</p>
            </div>
        </div>
        <ul class="app-menu">
            <li><a class="app-menu__item"  href="{{ url('/home') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Timeline</span></a></li>
            <li><a class="app-menu__item"  href="{{ url('/projects') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Project</span></a></li>
            <li><a class="app-menu__item" href="{{ url('/teamprojects') }}"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Team</span></a>
            </li>
            <li><a class="app-menu__item" href="{{ url('/timesheets') }}"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Timesheet</span></a>
            </li>
        </ul>
    </aside>

    <main class="app-content">
        @yield('content')
    </main>
</div>
<!-- Essential javascripts for application to work-->
<script src="{{URL::asset('js/app.js')}}"></script>
</body>
</html>
