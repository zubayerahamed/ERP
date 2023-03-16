@extends('layouts.admin.main')
@push('title')
    <title>Admin - Product</title>
@endpush
@section('vendor-styles')
    <x-data-table-css></x-data-table-css>
@endsection
@push('content-heading')
    <x-content-heading pageHeading="Product" showBredCrumb="true"></x-content-heading>
@endpush
@section('admin-main')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of Products</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped data-table">
                    <thead>
                        <tr>
                            <th data-nosort="Y">Image</th>
                            <th>Name</th>
                            <th>Short Description</th>
                            <th>Categories</th>
                            <th class="text-center">Active Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    @if ($product->getThumbnail != null)
                                        <img src="{{ $product->getThumbnail->file }}" alt="" id="product-thumbnail" style="width: 50px; height: 50px;">    
                                    @endif
                                </td>
                                <td>
                                    <p class="text-bold mb-0"><a href="{{ route('product.edit', $product->id) }}">{{ $product->title }}</a></p>
                                    <span>{{ 'ID:' . $product->id }} | <a href="{{ route('product.edit', $product->id) }}" alt="Edit Product">Edit</a> | <a href="{{ route('product.trash', $product->id) }}" alt="Trash Product">Trash</a></span>
                                </td>
                                <td>{{ $product->short_desc }}</td>
                                <td>
                                    @foreach ($product->categories as $cat)
                                        <li style="display: inline-block; list-style: none; padding: 5px 10px; background: #ddd; border-radius: 5px; font-size: 12px; cursor: pointer; margin-right: 5px;"><a target="_blank" href="{{ route('category.edit', $cat->slug) }}">{{ $cat->name }}</a></li>
                                    @endforeach
                                </td>
                                <td>
                                    @if ($product->active)
                                        <p class="text-bold text-success">Active</p>
                                    @else
                                        <p class="text-bold text-danger">Inactive</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
