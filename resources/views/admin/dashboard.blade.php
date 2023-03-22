@extends('layouts.admin.main')
@push('title')
    <title>Admin - Home</title>
@endpush
@push('content-heading')
    <x-content-heading pageHeading="Dashboard" showBredCrumb="false"></x-content-heading>
@endpush
@section('admin-main')
    <div class="col-md-12">
        All real contents will be go here
    </div>
@endsection
