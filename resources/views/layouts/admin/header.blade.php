<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    @stack('title')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('/assets/admin-assets/css/fontawesome.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('/assets/admin-assets/css/toastr.min.css') }}">
    <!-- Vendor styles -->
    @yield('vendor-styles')
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/admin-assets/css/kit.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/admin-assets/css/kit-ui.css') }}">
    <!-- Custom page Styles -->
    @yield('custom-page-styles')
</head>

<body class="hold-transition sidebar-mini">
    <a href="{{ url('/') }}" class="basePath"></a>
    <a href="{{ url('/admin') }}" class="adminBasePath"></a>

    <div class="wrapper">

        @include('layouts.admin.navbar-top')
