@extends('layouts.admin.main')
@push('title')
    <title>Admin - {{ $product->id != null ? 'Edit Product' : 'Add New Product' }}</title>
@endpush
@section('vendor-styles')
    <x-data-table-css></x-data-table-css>
@endsection
@push('content-heading')
    <x-content-heading pageHeading="{{ $product->id != null ? 'Edit Product' : 'Add New Product' }}" showBredCrumb="true"></x-content-heading>
@endpush
@section('admin-main')
    <form action="{{ $product->id == null ? route('product.save') : route('product.update', $product->id) }}" method="POST" style="display: inline-block; width: 100%; padding: 0; margin: 0; box-sizing: border-box;">
        @csrf
        @if ($product->id != null)
            @method('PUT')
        @endif
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product Name</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="title" placeholder="Enter Product Name" value="{{ old('title', $product->title) }}" required>
                                @error('title')
                                    <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product Description</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <textarea class="form-control" name="desc">{{ old('desc', $product->desc) }}</textarea>
                                @error('desc')
                                    <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product Data</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product Short Description</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <textarea class="form-control" name="short_desc">{{ old('short_desc', $product->short_desc) }}</textarea>
                                @error('short_desc')
                                    <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Publish</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('product.add-new') }}" class="btn btn-warning">Clear</a>
                            <button type="submit" class="btn btn-success product-submit-btn">Submit</button>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product Categories</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="max-height: 300px; overflow: auto;">
                            <div class="form-group">
                                <!-- Recursive way of displaying category -->
                                @include('layouts.inc.category-recursive', ['categories' => $categories, 'margin' => 0, 'product' => $product])
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product Image</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product Gallery</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product Tags</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('vendor-scripts')
    <x-data-table-js></x-data-table-js>
@endsection
@section('custom-page-scripts')
    <script></script>
@endsection
