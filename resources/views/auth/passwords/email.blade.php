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
        <form class="login-form mt-5" method="POST" action="{{ route('password.email') }}">
            @csrf
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
            <div class="form-group">
                <label class="control-label">EMAIL</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
            <div class="form-group btn-container">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fa fa-unlock fa-lg fa-fw"></i>
                        {{ __('RESET') }}
                    </button>
            </div>
            <div class="form-group mt-3">
            <p class="semibold-text mb-0 m-center"><a href="/login"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
            <p class="semibold-text mb-0 m-center"><a href="/register">Register<i class="fa fa-angle-right fa-fw"></i></a></p>
          </div>
        </form>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
      </div>
</section>
@endsection
