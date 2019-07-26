@extends('layouts.app')

@section('content')
    <div class="row">
         <div class="col-md-3">
         </div>
        <div class="col-md-5">
            <div class="tile">
                <h3 class="tile-title">Change Password</h3>
                <div class="tile-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form class="form-group" role="form" method="POST" action="{{ route('password.update') }}">

                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                            <label for="current_password" class="control-label">Current Password</label>
                            <input id="current_password" type="password" class="form-control" name="current_password" autofocus>
                            <span class="text-danger">{{ $errors->first('current_password') }}</span>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">New Password</label>
                            <input id="password" type="password" class="form-control" name="password">
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        </div>
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password_confirmation" class=" control-label">New Password Confirmation</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                        </div>
                        <div class="tile-footer m-center">
                            <button type="submit" class="btn btn-primary ">
                                Change Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
        </div>
    </div>
@endsection
