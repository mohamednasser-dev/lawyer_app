<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from www.nobleui.com/html/template/demo_4/dashboard-one.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 25 Sep 2020 17:40:34 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lawyer App</title>
    <!-- core:css -->
    <link rel="stylesheet" href="{{url('/assets/vendors/core/core.css')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
@yield('styles')
<!-- end plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{url('/assets/fonts/feather-font/css/iconfont.css')}}">
    <link rel="stylesheet" href="{{url('/assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <!-- endinject -->
    <!-- Layout styles -->
    @if(session('theme')=='light')

    <link rel="stylesheet" href="{{url('/assets/css/demo_1/style.css')}}">
    @else
    <link rel="stylesheet" href="{{url('/assets/css/demo_2/style.css')}}">

    @endif
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{url('/assets/images/favicon.png')}}"/>
    <link rel="stylesheet" href="{{url('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{url('/plugins/toastr/toastr.min.css') }}">

</head>

@if(session('lang')=='en')

    <body class="ltr">

    @else
        <body class="rtl">
        @endif
        <div class="main-wrapper">
