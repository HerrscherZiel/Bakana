@extends('layouts.user')

@section('content')
<div>
      <div class="tile row">
        <div class="col-md-12">
            <a href="/timelines/project" class="btn btn-primary">Show Project</a>
            <a href="/timelines/job" class="btn btn-primary">Show Job</a>
            <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Project
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    @foreach($val as $vals)
                        <a class="dropdown-item" href="/timelines/{{$vals->id_project}}">{{$vals->nama_project}}</a>
                    @endforeach
                </div>
            </div>

{{--            <div class="dropdown">--}}
{{--                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                    Project--}}
{{--                </button>--}}
{{--                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
{{--                    @foreach($val as $vals)--}}
{{--                        <a class="dropdown-item" href="/timelines/{{$vals->id_project}}">{{$vals->nama_project}}</a>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}

            <br><br>

            <br>
            {!! $calendar->calendar() !!}
        </div>
      </div>
<script type="text/javascript" src="{{URL::asset('docs/js/jquery-3.4.1.js')}}"></script>

<script type="text/javascript">
    var events = [];
  $.get('/events/get', function(result){
      events = result;
  });
  $('#calendar').fullCalendar({
      events: function (start, end, timezone, callback) {
          callback(events);
      }
  });
</script>
<!-- Calendar-->
<script type="text/javascript" src="{{URL::asset('docs/js/plugins/jquery-ui.custom.min.js')}}"></script>
{{--<script type="text/javascript" src="{{URL::asset('docs/js/plugins/moment.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{URL::asset('docs/js/plugins/fullcalendar.min.js')}}"></script>--}}
<script src="{{URL::asset('docs/js/mhmoment.min.js')}}"></script>
<script src="{{URL::asset('docs/js/mhfullcalendar.min.js')}}"></script>
<script src="{{URL::asset('docs/js/main.js')}}"></script>

{{--<script type="text/javascript" src="{{URL::asset('docs/js/fullcalendar.min.js')}}"></script>--}}

<!-- Option Ajax  -->
{{--<script type="text/javascript">--}}

{{--    $(document).ready(function($){--}}
{{--        $('#project').on('change', function() {--}}
{{--            $.ajaxSetup({--}}
{{--                headers: {--}}
{{--                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                }--}}
{{--            });--}}
{{--            if ($("#project").val() != "") {--}}
{{--                $.ajax({--}}
{{--                    type: "POST",--}}
{{--                    url: '/timelines/' + $("#project option:selected").val(),--}}
{{--                    data: { id: $("#project").val() },--}}
{{--                    dataType: "json",--}}
{{--                    success: function (data){--}}
{{--                        console.log('success')--}}
{{--                    },--}}
{{--                    error: function (xhr) {--}}
{{--                        alert("Something went wrong, please try again");--}}
{{--                    }--}}
{{--                })}--}}
{{--        });--}}
{{--    });--}}

{{--</script>--}}
</div>
{!! $calendar->script() !!}
@endsection