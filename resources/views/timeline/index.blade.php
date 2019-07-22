@extends('layouts.user')

@section('content')
<div class="appTimeline">
      <div class="tile row">
        <div class="col-md-12">
               {!! $calendar->calendar() !!}
        </div>
      </div>

@endsection
