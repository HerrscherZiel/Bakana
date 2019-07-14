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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

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
<!-- Page specific javascripts-->
<script type="text/javascript" src="{{URL::asset('docs/js/plugins/chart.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('docs/js/plugins/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('docs/js/plugins/select2.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('docs/js/plugins/bootstrap-datepicker.min.js')}}"></script>
<!-- Data table plugin-->
<script type="text/javascript" src="{{URL::asset('docs/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('docs/js/plugins/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
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
  
  $('#demoDate').datepicker({
    format: "dd/mm/yyyy",
    autoclose: true,
    todayHighlight: true
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
<script>
  $(".delete").on("submit", function(){
      return confirm("Are you sure want to delete?");
  });
</script>
<script>
  $('.bs-component [data-toggle="popover"]').popover();
  $('.bs-component [data-toggle="tooltip"]').tooltip();
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
