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
    <form class="login-form" method="POST" action="{{ route('login') }}">
        @csrf
      <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
      <div class="form-group">
        <input  id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus placeholder="Email">
         @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      <div class="form-group">
        <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password"  autocomplete="current-password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      <div class="form-group">
        <div class="utility">
          <div class="animated-checkbox">
            <label>
              <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}><span class="label-text" for="remember">Stay Signed in</span>
            </label>
          </div>
           @if (Route::has('password.request'))
          <p class="semibold-text mb-2"><a href="/password/reset">Forgot Password ?</a></p>
          @endif
        </div>
      </div>
      <div class="form-group btn-container">
        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
        <p class="semibold-text mt-5"><a href="/register">Make account here</a></p>
      </div>
    </form>
  </div>
</section>
@endsection
