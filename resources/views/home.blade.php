@extends('layouts.app')

@section('content')
<div class="appTimeline">
      <div class="row">
        <div class="col-md-12">
          <div class="tile row">
            <div class="col-md-3">
              <div id="external-events">
              	<h4 class="mb-4"><a href="https://fullcalendar.io/docs"> FullCalendar.io</a></h4>
                <h5>Draggable Events</h5>
                <div class="fc-event">Timeline 1</div>
                <div class="fc-event">Timeline 2</div>
                <div class="fc-event">Timeline 3</div>
                <div class="fc-event">Timeline 4</div>
                <div class="fc-event">Timeline 5</div>
                <p class="animated-checkbox mt-20">
                  <label>
                    <input id="drop-remove" type="checkbox"><span class="label-text">Remove after drop</span>
                  </label>
                </p>
              </div>
            </div>
            <div class="col-md-9">
              <div id="calendar"></div>
            </div>
          </div>
        </div>
      </div>
<div class="tile">
	  <h1>daypilot-project</h1>
	  <div><a href="https://javascript.daypilot.org/">DayPilot for JavaScript</a> - HTML5 Calendar/Scheduling Components for JavaScript/Angular/React</div>
	  <div id="dp"></div>
	  <div class="generated">Generated using <a href="https://builder.daypilot.org/">DayPilot UI Builder</a>.</div>
	</div>
@endsection
