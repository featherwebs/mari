<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>{{ fw_setting('title') }}: Admin Login</title>

    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    {{--<link href="{{ asset('css/stylesheet.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
                        <small>Baked with mari 0.21 beta</small>
                    </header>
                </div>

            </div>
            <div class="col-md-7 col-lg-6">
                <aside class="login-box-wrapper">

                    <form class="form-signin" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <h2 class="form-signin-heading">mari<span class="cms-text">CMS</span></h2>
                        <div class="form-group">
                            <input type="email" name='email' class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">

                            <input type="password" class="form-control" id="password" name='password' placeholder="Password">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                                Remember me
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary login-button">Login</button>
                        <a href="{{ url('/') }}">Back to {{ fw_setting('title') }}</a>
                    </form>

                </aside>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-12">
                <footer>
                    <ul class="footer-link">
                        <li><a href="#">2017 Featherwebs</a></li>
                        <li><a href="#">Home</a></li>
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
</body>
</html>