@extends('layouts.user')

@section('content')
<div>
      <div class="tile row">
        <div class="col-md-12">
               {!! $calendar->calendar() !!}
{{--                {!! $calendar->script() !!}--}}
        </div>
      </div>

@endsection
