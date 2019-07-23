@extends('layouts.user')

@section('content')
<div>
      <div class="tile row">
        <div class="col-md-12">
            <a href="/timelines" class="btn btn-primary">Show Module</a>
            <a href="/timelines/job" class="btn btn-primary">Show Job</a><br><br>

               {!! $calendar->calendar() !!}
{{--                {!! $calendar->script() !!}--}}
        </div>
      </div>

@endsection
