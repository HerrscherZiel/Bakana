@extends('layouts.user')

@section('content')
<div class="appTimeline">
      <div class="row">
        <div class="col-md-12">
          <div class="tile row">
            <div class="col-md-3">
              <div id="external-events">
              	<h4 class="mb-4"><a href="https://fullcalendar.io/docs"> FullCalendar</a></h4>
                <h5>Draggable Events</h5>
                <div class="fc-event">Timeline 1</div>
                <div class="fc-event">Timeline 2</div>
                <div class="fc-event">Timeline 3</div>
                <div class="fc-event">Timeline 4</div>
                <p class="animated-checkbox mt-20">
                  <label>
                    <input id="drop-remove" type="checkbox"><span class="label-text">Remove after drop</span>
                  </label>
                </p>
              </div>
            </div>
            <div class="col-md-9">
               {!! $calendar->calendar() !!}
            </div>
          </div>
        </div>
      </div>

@endsection
