<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    @if(isset($page))
        <meta name="title" content="{{ fw_setting('meta_title', $page->meta_title) }}">
        <meta name="description" content="{{ fw_setting('meta_title', $page->meta_title) }}">
        <meta name="keywords" content="{{ fw_setting('meta_keywords', $page->meta_keywords) }}">
    @elseif(isset($post))
        <meta name="title" content="{{ fw_setting('meta_title', $post->meta_title) }}">
        <meta name="description" content="{{ fw_setting('meta_title', $post->meta_title) }}">
        <meta name="keywords" content="{{ fw_setting('meta_keywords', $post->meta_keywords) }}">
    @else
        <meta name="title" content="{{ fw_setting('meta_title') }}">
        <meta name="description" content="{{ fw_setting('meta_description') }}">
        <meta name="keywords" content="{{ fw_setting('meta_keywords') }}">
    @endif

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/stylesheet.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <style>
        [v-cloak] > * { display:none }
        [v-cloak]::before { content: "loading…" }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @stack('styles')
</head>
<body>
@include('partials.navbar')
@yield('content')

<!-- Scripts -->
@include('layouts.footer')
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/slick.min.js"></script>
<script src="/js/wow.min.js"></script>
<script> new WOW().init(); </script>
<script type="text/javascript" src="/js/custom.js"></script>
<script>
    window.Laravel = { csrfToken: '{{ csrf_token() }}' };
    $(document).ready(function () {
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var hash = '#'+$(e.target).attr('href').substr(1);
            if(history.pushState) {
                history.pushState(null, null, hash);
            }
            else {
                location.hash = hash;
            }
        });
        if (location.hash !== '') $('a[href="' + location.hash + '"]').tab('show');
    });
</script>
@stack('scripts')
</body>
</html>
