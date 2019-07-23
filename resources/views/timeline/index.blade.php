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
{{--                {!! $calendar->script() !!}--}}


        </div>
      </div>

@endsection
