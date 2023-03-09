@extends('layouts.admin.main')
@push('title')
    <title>Admin - Home</title>
@endpush
@section('vendor-styles')
    <!-- Page Related Styles will be declared here -->
@endsection
@push('content-heading')
    <x-content-heading pageHeading="Dashboard" showBredCrumb="false"></x-content-heading>
@endpush
@section('admin-main')
    <div class="col-md-12">
        All real contents will be go here
    </div>
@endsection
@section('vendor-scripts')
    <!-- Page Related Scripts will be declared here -->
@endsection
