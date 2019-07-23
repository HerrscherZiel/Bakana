@extends('layouts.user')

@section('content')
<div>
      <div class="tile row">
        <div class="col-md-12">
            <a href="/timelines/project" class="btn btn-primary">Show Project</a>
            <a href="/timelines" class="btn btn-primary">Show Module</a><br><br>

               {!! $calendar->calendar() !!}
{{--                {!! $calendar->script() !!}--}}
        </div>
      </div>

@endsection
