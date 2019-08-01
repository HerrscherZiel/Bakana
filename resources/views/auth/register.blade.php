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
    <form class="login-form" method="POST" action="{{ route('register') }}">
        @csrf
      <h3 class="login-head pb-2"><i class="fa fa-lg fa-fw fa-user"></i>REGISTER</h3>
      <div class="form-group">
        <input  id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nama">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      <div class="form-group">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      <div class="form-group">
        <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" required autocomplete="new-password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      <div class="form-group">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
      </div>
      <input type="hidden" value="2" name="role_id">
      <div class="form-group btn-container">
        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>REGISTER</button>
        <p class="semibold-text mt-2 m-center"><a href="/login">Login here<i class="fa fa-angle-right fa-fw"></i></a></p>
      </div>
    </form>
  </div>
</section>
@endsection
