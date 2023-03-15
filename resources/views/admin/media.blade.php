@extends('layouts.admin.main')
@push('title')
    <title>Admin - Media</title>
@endpush
@section('vendor-styles')
    <x-data-table-css></x-data-table-css>
@endsection
@push('content-heading')
    <x-content-heading pageHeading="Media" showBredCrumb="true"></x-content-heading>
@endpush
@section('admin-main')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Library</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                
                data

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
@section('vendor-scripts')
    <x-data-table-js></x-data-table-js>
@endsection
@section('custom-page-scripts')
    <script></script>
@endsection
