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

<!-- Bidvertiser2035523 -->
    
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') - {{ config('app.name', 'TechnoTrack BD') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="Techno track,gps tracker,gps tracking,gps tracker platform,vehicle tracking,vehicle tracker,car gps tracker,best gps tracker,gps tracker bangladesh,finder gps tracker,">
   <meta name="description" content="Techno Track Solutions BD offers real time GPS Vehicle Tracking Solution. Our GPS Tracking Software enables you to track accurate location of your Fleet & Vehicles.">
    
    <meta property="fb:pages" content="105938377679968"/>
    <meta property="og:site_name" content="Techno Track Solutions BD"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" href="{{asset("public/assets/backend/img/technologo.png")}}">
    <link rel="shortcut icon" href="{{asset("public/assets/frontend/images/techno/favicon/favicon2.png")}}">

    <!-- Google Font (font-family: 'Open Sans', sans-serif;) -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700" rel="stylesheet">
    <!-- Google Font (font-family: 'Roboto', sans-serif;) -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <link rel="stylesheet" href="{{asset("public/assets/frontend/css/bootstrap.css")}}">
    <link rel="stylesheet" href="{{asset("public/assets/frontend/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("public/assets/frontend/css/plugins.css")}}">
    <link rel="stylesheet" href="{{asset("public/assets/frontend/css/style2.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/frontend/css/testimonial.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/frontend/css/fontawesome.css')}}">

    <!-- Please Remove this line after choosing color file -->
    <link rel="stylesheet" href="{{asset("public/assets/frontend/css/tm-customizer.css")}}">
    <link rel="stylesheet" href="#" data-color-css>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stack('css')

    <STYLE>
        .service_border_radious{
            border: 1px solid #1cbac9;
            background: #1cbac966;
            border-radius: 5%;
        }
        .service_image{
            height: 164px;
        }
        .hover:hover{
            color: white !important;
        }
        @media only screen and (max-width: 600px) {
          .header-topsocial {
            display: none;
          }

           .header-topinfo ul li a{
            font-size: 10px;
          }
        }
        

    </STYLE>
</head>

<body>
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
      
    {{--<div class="se-pre-con"></div>--}}
    <div id="wrapper" class="wrapper">
        <!-- Header Area -->
        <div class="header">

            <!-- Header Top Area -->
            <div class="header-toparea">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="header-topinfo">
                                @php($contact = \App\Contact_info::all())

                                @if(count($contact) > 0)
                                    @php($contact_data = \App\Contact_info::all()->first())
                                <ul>
                                    <li><a href="tel://{{$contact_data->header_phone_1}}" style="color:#6c63ff;font-weight: bold;"><i class="fa fa-phone"></i><span>Sales:</span> {{$contact_data->header_phone_1}}</a></li>
                                    <li><a href="tel://{{$contact_data->header_phone_2}}" style="color:#f15922;font-weight: bold;"><i class="fa fa-phone"></i><span>Billing:</span> {{$contact_data->header_phone_2}}</a></li>
                                    <li><a href="tel://{{$contact_data->header_phone_3}}" style="color:green;font-weight: bold;"><i class="fa fa-phone"></i><span>Support:</span> {{$contact_data->header_phone_3}}</a></li>
                                </ul>
                                 @endif

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--// Header Top Area -->

        </div>
        <!--// Header Area -->
@include('frontend.layout.main_menu2')
<!-- Main Content -->
        <main class="main-content" style="background: {{Request::is('user/user_dashboard')?'#136b63fc': ''}}{{Request::is('online_payment*')?'#136b63fc': ''}}" >
            @yield('content')
        </main>
<!--// Main Content -->
@include('frontend.layout.footer')
@stack('js')
