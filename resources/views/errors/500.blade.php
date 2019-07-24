@extends('layouts.app')

@section('content')
    <div class="page-error tile">
        <h1><i class="fa fa-exclamation-circle mr-3"></i>500</h1>
        <br>
        <h2><p>Internal Server Error</p></h2>
        <br>
        <p><a class="btn btn-primary mr-3" href="{{url('/home')}}">Go to Home</a>
            <a class="btn btn-secondary ml-3" href="javascript:window.history.back();">Go Back</a></p>
    </div>
@endsection
