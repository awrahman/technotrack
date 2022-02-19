<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title') - {{ config('app.name', 'TechnoTrack BD') }}</title>
<meta name="csrf-token" content="{!! csrf_token() !!}">
  <meta name="keywords" content="Techno track,gps tracker,gps tracking,gps tracker platform,vehicle tracking,vehicle tracker,car gps tracker,best gps tracker,gps tracker bangladesh,finder gps tracker, tracking devices, bike tracker">
   <meta name="description" content="Techno Track Solutions BD offers real time GPS Vehicle Tracking Solution. Our GPS Tracking Software enables you to track accurate location of your Fleet & Vehicles.">
    <meta property="fb:pages" content="105938377679968"/>
    <meta property="og:site_name" content="Techno Track Solutions BD"/>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{asset("public/assets/frontend/images/techno/favicon/favicon2.png")}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/assets/backend/css/font-awesome-animation.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('public/assets/backend/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/assets/backend/css/bootstrap-datepicker.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset("public/assets/backend/css/simplepicker.css")}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .nav-link{
            color: black !important;
        }
        .nav-header{
            color: black !important;
        }
        .color_black{
            color: black;
        }
    </style>
    @stack('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


<!-- Top Bar -->
@include('backend.layout.header')
<!-- #Top Bar -->

<!-- Left Sidebar -->
@include('backend.layout.left_sidebar')
<!-- #Left Sidebar -->


      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@yield('title')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="@yield('link')">@yield('main_menu')</a></li>
              <li class="breadcrumb-item active">@yield('active_menu')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">




        @yield('content')




      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->




@include('backend.layout.footer')
@stack('js')
