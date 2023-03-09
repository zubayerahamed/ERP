@extends('layouts.admin.main')
@push('title')
    <title>Admin - Category</title>
@endpush
@section('vendor-styles')
    <!-- Page Related Styles will be declared here -->
@endsection
@push('content-heading')
    <x-content-heading pageHeading="Category" showBredCrumb="true"></x-content-heading>
@endpush
@section('admin-main')
    <div class="col-md-4">
        <!-- general form elements disabled -->
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Crate Category/Sub-Category</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form>

                    <div class="form-group">
                        <label>Text</label>
                        <input type="text" class="form-control" placeholder="Enter ...">
                    </div>
                    <div class="form-group">
                        <label>Select</label>
                        <select class="form-control">
                            <option>option 1</option>
                            <option>option 2</option>
                            <option>option 3</option>
                            <option>option 4</option>
                            <option>option 5</option>
                        </select>
                    </div>

                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <!-- general form elements disabled -->
    </div>

    <div class="col-md-8">
        <!-- general form elements disabled -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">List of Categories</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                table wi go here
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <!-- general form elements disabled -->
    </div>
@endsection
@section('vendor-scripts')
    <!-- Page Related Scripts will be declared here -->
@endsection
