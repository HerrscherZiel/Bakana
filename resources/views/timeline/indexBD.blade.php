@extends('layouts.user')

@section('content')
<div>
      <div class="tile row">
        <div class="col-md-12">
{{--            <a href="/timelines/project" class="btn btn-primary">Show Project</a>--}}
{{--            <a href="/timelines/job" class="btn btn-primary">Show Job</a>--}}
            <h4>{{$ii}}</h4>
            
            <ul class="nav nav-pills mt-2 mb-5" >
                <li class="nav-item dropdown">
                  <a class="nav-link active dropdown-toggle btn btn-info" style="width: 215%" data-toggle="dropdown" href="#" role="button " aria-haspopup="true" aria-expanded="false">Project</a>
                  <div class="dropdown-menu" style="width: 215%">
                    @foreach($val as $vals)
                    <a class="dropdown-item" href="/timelines/{{$vals->id_project}}">{{$vals->nama_project}}</a>
                    @endforeach
                  </div>
                </li>
            </ul>
            {!! $calendar->calendar() !!}
        </div>
      </div>
    <script src="{{URL::asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{URL::asset('js/popper.min.js')}}"></script>
    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
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
    <script type="text/javascript" src="{{URL::asset('js/plugins/jquery-ui.custom.min.js')}}"></script>
    <script src="{{URL::asset('js/mhmoment.min.js')}}"></script>
    <script src="{{URL::asset('js/mhfullcalendar.min.js')}}"></script>

    <script src="{{URL::asset('js/main.js')}}"></script>


    <!-- Option Ajax  -->
    <script type="text/javascript">

        $(document).ready(function($){
            $('#project').on('change', function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                if ($("#project").val() != "") {
                    $.ajax({
                        type: "POST",
                        url: '/timelines/' + $("#project option:selected").val(),
                        data: { id: $("#project").val() },
                        dataType: "json",
                        success: function (data){
                            console.log('success')
                            $('#calendar').fullCalendar( 'removeEvents' ,event );
                            $('#calendar').fullCalendar(
                                {"header":{
                                        "left":"prev,next today",
                                        "center":"title",
                                        "right":"month,agendaWeek,agendaDay"
                                    },
                                    "eventLimit":true,
                                    "events":[]});

                            {{--                        {!! $calendar->script() !!}--}}
                            // $('#calendar').fullCalendar({
                            //     events: function (start, end, timezone, callback) {
                            //         callback(events);
                            //     }
                            // });
                        },
                        error: function (xhr) {
                            alert("Something went wrong, please try again");
                        }
                    })}
            });
        });

    </script>
</div>
{!! $calendar->script() !!}
@endsection
