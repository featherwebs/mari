<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <meta name="title" content="{!! fw_meta_title($post ?? $page ?? false) !!}">
    <meta name="description" content="{!! fw_meta_desc($post ?? $page ?? false) !!}">
    <meta name="keywords" content="{!! fw_meta_keywords($post ?? $page ?? false) !!}">

    <meta property="og:title" content="{!! fw_meta_title($post ?? $page ?? false) !!}">
    <meta property="og:description" content="{!! fw_meta_desc($post ?? $page ?? false) !!}">
    <meta property="og:image" content="{!! fw_meta_image($post ?? $page ?? false) !!}">
    <meta property="og:url" content="{!! request()->url() !!}">
    <meta property="og:site_name" content="{!! fw_setting('title') !!}">

    <meta name="twitter:title" content="{!! fw_meta_title($post ?? $page ?? false) !!}">
    <meta name="twitter:description" content="{!! fw_meta_desc($post ?? $page ?? false) !!}">
    <meta name="twitter:image" content="{!! fw_meta_image($post ?? $page ?? false) !!}">
    <meta name="twitter:card" content="summary_large_image">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/stylesheet.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Styles -->

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
@stack('scripts')
</body>
</html>