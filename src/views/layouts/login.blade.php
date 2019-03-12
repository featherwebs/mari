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
            <small>Baked with mari v1</small>
          </header>
        </div>
      </div>
      @yield('content')
    </div>

    <div class="row">
      <div class="col-sm-12">
        <footer>
          <ul class="footer-link">
            <li><a href="http://featherwebs.com" target="_blank">{{ date('Y') }} Featherwebs</a></li>
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
</body>
</html>