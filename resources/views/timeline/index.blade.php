@extends('layouts.user')

@section('content')
<div>
      <div class="tile row">
        <div class="col-md-12">
            <a href="/timelines/project" class="btn btn-primary">Show Project</a>
            <a href="/timelines/job" class="btn btn-primary">Show Job</a><br><br>

            <select class="form-control" id="project" name="project">
                <option disabled="" selected="">Select Project</option>
                @foreach($val as $vals)
                    <option value="{{$vals->id_project}}">{{$vals->nama_project}}</option>
                @endforeach
            </select>
            <br>
            {!! $calendar->calendar() !!}
        </div>
      </div>
<script type="text/javascript" src="{{URL::asset('js/jquery-3.4.1.js')}}"></script>

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
{{--<script type="text/javascript" src="{{URL::asset('js/plugins/moment.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{URL::asset('js/plugins/fullcalendar.min.js')}}"></script>--}}
<script src="{{URL::asset('js/mhmoment.min.js')}}"></script>
<script src="{{URL::asset('js/mhfullcalendar.min.js')}}"></script>
<script src="{{URL::asset('js/main.js')}}"></script>

{{--<script type="text/javascript" src="{{URL::asset('js/fullcalendar.min.js')}}"></script>--}}

<!-- Option Ajax  -->
<script type="text/javascript">
    {{--$(document).ready(function($){--}}
    {{--    $('#project').change(function(){--}}
    {{--        $.get("{{ url('timelines/{id}')}}",--}}
    {{--            { option: $(this).val() },--}}
    {{--            function(data) {--}}
    {{--                var model = $('#model');--}}
    {{--                model.empty();--}}

    {{--                $.each(data, function(index, element) {--}}
    {{--                    model.append("<option value='"+ element.id +"'>" + element.name + "</option>");--}}
    {{--                });--}}
    {{--            });--}}
    {{--    });--}}
    {{--});--}}

    // $('#project').on('change', function() {
    //     if ($("#project").val() != "") {
    //         $.ajax({
    //             url: '/timelines/'+$(this).val(),
    //             type: 'POST',
    //             // data: {},
    //             success: function (response){
    //                 // $("#calendar").replaceWith(response);
    //                 console.log('success');
    //             },
    //             error: function (xhr) {
    //                 alert("Something went wrong, please try again");
    //             }
    //         });
    //     }
    //
    // });

    // var id = $("#project option:selected").val();

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
                        console.log('success');
                    },
                    error: function (xhr) {
                        alert("Something went wrong, please try again");
                    }
                })}
        });
    });



</script>
{!! $calendar->script() !!}
@endsection
