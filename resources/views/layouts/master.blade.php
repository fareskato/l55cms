<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="favicon.ico">
    <title>Home</title>
    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend/css/font-awesome.min.css')}}">
    <!-- Custom styles for this template -->
    <link href="{{asset('css/jquery.bxslider.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>
<body>
{{--  Master Layout For All Frontend Pages   --}}

<!-- Navigation -->
@include('frontend.top_navigation')

<div class="container">
    @yield('content')
</div><!-- /.container -->
<footer class="footer">

    <div class="footer-socials">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-instagram"></i></a>
        <a href="#"><i class="fa fa-google-plus"></i></a>
        <a href="#"><i class="fa fa-dribbble"></i></a>
        <a href="#"><i class="fa fa-reddit"></i></a>
    </div>

    <div class="footer-bottom">
        <i class="fa fa-copyright"></i> Copyright 2015. All rights reserved.<br>
        Theme made by <a href="http://www.moozthemes.com">MOOZ Themes</a>
    </div>
</footer>

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
{{--<script src="{{asset('js/jquery.min.js')}}"></script>--}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="{{asset('backend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery.bxslider.min.js')}}"></script>
<script src="{{asset('js/mooz.scripts.min.js')}}"></script>
</body>
</html>