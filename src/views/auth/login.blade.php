<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>Shaligram</title>

    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}" />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    {{--<link href="{{ asset('css/stylesheet.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .form-signin-heading img {
            margin: 0 auto;
        }
    </style>
</head>
<body>

<!-- LOGIN PAGE  -->
<section id="login_board">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 col-lg-6">
                <div id="login-texts-wrapper">
                    <header id="login-texts">
                        <h1>mari <span class="trademark"> &#8482; </span></h1>
                        <h4>Simple, Clean, and Consistent</h4>
                        <h4>Control Panel</h4>
                        <small>Baked with mari</small>
                    </header>
                </div>

            </div>
            <div class="col-md-7 col-lg-6">
                <aside class="login-box-wrapper">
                    <form class="form-signin" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-signin-heading">
                            <img src="{{ fw_setting('logo') }}" class="img-responsive">
                        </div>
                        <div class="form-group">
                            <input type="email" name='email' class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" name="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                                Remember me
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary login-button">
                            Login
                        </button>
                        <a href="{{ url('/') }}" class="back"><i class="fa fa-arrow-left"></i> Back to {{ fw_setting('title') }}</a>
                    </form>

                </aside>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-12">
                <footer>
                    <ul class="footer-link">
                        <li><a href="http://www.featherwebs.com" target="_blank">{{ date('Y') }} Featherwebs</a></li>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Send Feedback</a></li>
                    </ul>
                </footer>
            </div>
        </div>
    </div>
</section>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="{{ asset('js/slick.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
</body>
</html>