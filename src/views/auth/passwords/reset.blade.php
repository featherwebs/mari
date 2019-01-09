@extends('layouts.login')
@section('content')
    <div class="col-md-7 col-lg-6">
        <aside class="login-box-wrapper">
            <form class="form-signin" method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}
                <h2 class="form-signin-heading">mari<span class="cms-text">CMS</span></h2>
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ $email or old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
                    @if ($errors->has('password'))
                        <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                  <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary login-button">
                    Reset Password
                </button>

            </form>
        </aside>
    </div>
@endsection
