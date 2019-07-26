@extends('layouts.app2')

@section('content')
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
  <div class="logo">
    <h1>Timeline</h1>
  </div>
  <div class="login-box">
    <form class="login-form" method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Reset Password</h3>
        <div class="form-group">
            <label for="email" class="control-label">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
        </div>
        <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block">
                <i class="fa fa-unlock fa-lg fa-fw"></i>
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
   </div>
</section>
@endsection
