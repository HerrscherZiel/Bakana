@extends('layouts.app')

@section('content')
<div class="page-error tile">
        <h1><i class="fa fa-exclamation-circle"></i> Error 403</h1>
        <p>Unauthorized Action.</p>
        <p><a class="btn btn-primary" href="{{url('/home')}}">Go to Home</a>
        <a class="btn btn-secondary" href="javascript:window.history.back();">Go Back</a></p>
      </div>
@endsection
