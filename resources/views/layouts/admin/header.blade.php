<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    
    @stack('title')

    <!-- All Theme Related CSS Files -->
    <x-theme-css></x-theme-css>
    <!-- Custom page related styles -->
    @yield('custom-page-styles')
</head>

<body class="hold-transition sidebar-mini">
    <a href="{{ url('/') }}" class="basePath"></a>
    <a href="{{ url('/admin') }}" class="adminBasePath"></a>

    <div class="wrapper">

        @include('layouts.admin.navbar-top')
