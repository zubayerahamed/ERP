@extends('layouts.main')
@push('title')
    <title>Home</title>
@endpush
@section('front-end-main')
    <a href="{{ url('/admin') }}">Admin Panel</a>
@endsection