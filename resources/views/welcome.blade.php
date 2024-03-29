<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Timeline</title>

        <link rel="stylesheet" type="text/css" href="docs/css/main.css">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>
    <body>
        <section class="material-half-bg">
            <div class="cover"></div>
        </section>
        <section class="login-content">
            <div class="logo">
                <h1>Timeline</h1>
            </div>
          <div class="login-box">
            <form class="login-form" method="POST" action="{{ route('home') }}">
                @csrf
              <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
              <div class="form-group">
                <input  id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required autocomplete="email" autofocus>
                 @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" required autocomplete="current-password">
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
                  <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Forgot Password ?</a></p>
                  @endif
                </div>
              </div>
              <div class="form-group btn-container">
                <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
              </div>
            </form>
            <form class="forget-form" method="POST" action="{{ route('password.email') }}">
                 @csrf
              <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
              <div class="form-group">
                <label class="control-label">EMAIL</label>
                <input class="form-control @error('email') is-invalid @enderror" type="email" placeholder="Email" required autocomplete="email" autofocus>
                 @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group btn-container">
                <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
              </div>
              <div class="form-group mt-3">
                <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
              </div>
            </form>
          </div>
        </section>
         <!-- Essential javascripts for application to work-->
    <script src="docs/js/jquery-3.2.1.min.js"></script>
    <script src="docs/js/popper.min.js"></script>
    <script src="docs/js/bootstrap.min.js"></script>
    <script src="docs/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="docs/js/plugins/pace.min.js"></script>
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
        $('.login-box').toggleClass('flipped');
        return false;
      });
    </script>
    </body>
</html>
