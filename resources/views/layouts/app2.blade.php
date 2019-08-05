<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Timeline</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/main.css')}}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="sidebar-mini rtl">
    <div id="app">
            @yield('content')
    </div>
 <!-- Essential javascripts for application to work-->
<script src="{{URL::asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{URL::asset('js/popper.min.js')}}"></script>
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('js/main.js')}}"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{URL::asset('js/plugins/pace.min.js')}}"></script>
<script src="{{URL::asset('js/moment.min.js')}}"></script>
<script src="{{URL::asset('js/fullcalendar.min.js')}}"></script>

</body>
</html>
