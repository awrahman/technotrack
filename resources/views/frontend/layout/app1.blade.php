<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-166221117-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-166221117-1');
    </script>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') - {{ config('app.name', 'TechnoTrack BD') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" href="{{asset("public/assets/backend/img/technologo.png")}}">
    <link rel="shortcut icon" href="{{asset("public/assets/frontend/images/techno/favicon/favicon2.png")}}">

    <!-- Google Font (font-family: 'Open Sans', sans-serif;) -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700" rel="stylesheet">
    <!-- Google Font (font-family: 'Roboto', sans-serif;) -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <link rel="stylesheet" href="{{asset("public/assets/frontend/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("public/assets/frontend/css/plugins.css")}}">
    <link rel="stylesheet" href="{{asset("public/assets/frontend/css/style-liberty.css")}}">


    <!-- 
    <link rel="stylesheet" href="{{asset("public/assets/frontend/css/tm-customizer.css")}}">
    <link rel="stylesheet" href="#" data-color-css>

    <link rel="stylesheet" href="{{asset("public/assets/frontend/css/custom.css")}}">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stack('css')

    
</head>

<body class="cbp-spmenu-push">
<!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v7.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="105938377679968"
  theme_color="#17a2b8"
  logged_in_greeting="Hi there! How can we help you?"
  logged_out_greeting="Hi there! How can we help you?">
          
      </div>
@include('frontend.layout.main_menu1')
<!-- Main Content -->
        <main>
            @yield('content')
        </main>
        <!--// Main Content -->
@include('frontend.layout.footer1')
@stack('js')
