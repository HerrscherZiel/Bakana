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
    <link rel="stylesheet" type="text/css" href="{{URL::asset('docs/css/main.css')}}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="sidebar-mini rtl">
    <div id="app">
            @yield('content')
    </div>
 <!-- Essential javascripts for application to work-->
<script src="{{URL::asset('docs/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{URL::asset('docs/js/popper.min.js')}}"></script>
<script src="{{URL::asset('docs/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('docs/js/main.js')}}"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{URL::asset('docs/js/plugins/pace.min.js')}}"></script>

<script type="text/javascript">
  $('#sl').click(function(){
    $('#tl').loadingBtn();
    $('#tb').loadingBtn({ text : "Signing In"});
  });
  
  $('#el').click(function(){
    $('#tl').loadingBtnComplete();
    $('#tb').loadingBtnComplete({ html : "Sign In"});
  });
  
  $('#demoDate').datepicker({
    format: "dd/mm/yyyy",
    autoclose: true,
    todayHighlight: true
  });
  
  $('#demoSelect').select2();
</script>
<!-- Google analytics script-->
<script type="text/javascript">
  // Login Page Flipbox control
  $('.login-content [data-toggle="flip"]').click(function() {
    $('.login-box').toggleClass('flipped');
    return false;
  });
</script>
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
