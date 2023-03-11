@extends('layouts.admin.main')
@push('title')
    <title>Admin - Category</title>
@endpush
@section('vendor-styles')
    <x-data-table-css></x-data-table-css>
    <x-select2-css></x-select2-css>
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
            <form id="mainform" action="{{ $category->id == null ? route('category.save') : route('category.update', $category->id) }}" method="POST">
                @csrf
                @if ($category->id != null)
                    @method('PUT')
                @endif

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Category Name" value="{{ old('name', $category->name) }}" required>
                        @error('name')
                            <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" name="slug" value="{{ old('slug', $category->slug) }}" placeholder="Enter Category Slug" {{ $category->id != null ? 'readonly' : '' }}>
                    </div>
                    <div class="form-group">
                        <label for="parent_category_id">Parent Category</label>
                        <select class="form-control select2bs4" name="parent_category_id">
                            <option value="">-- Select --</option>
                            @foreach ($category->allCategoriesExceptChildsAndSelf as $cat)
                                <option value="{{ $cat->id }}" {{ $category->getParentCategory != null && $category->getParentCategory->id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="seqn">Sequence</label>
                        <input type="number" class="form-control" name="seqn" placeholder="Sequence" min="0" step="1" value="0">
                    </div>
                    {{-- <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="active" checked>
                            <label for="customCheckbox2" class="custom-control-label">Active?</label>
                        </div>
                    </div> --}}
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('category.page') }}" class="btn btn-warning">Clear</a>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
        <!-- general form elements disabled -->
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of Categories</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Parent</th>
                            <th>Sequence</th>
                            <th>Active?</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td><a href="{{ route('category.edit', $category->slug) }}">{{ $category->name }}</a></td>
                                <td>
                                    @if ($category->getParentCategory != null)
                                        <a href="{{ route('category.edit', $category->getParentCategory->slug) }}">{{ $category->getParentCategory->name }}</a>
                                    @endif
                                </td>
                                <td>{{ $category->seqn }}</td>
                                <td>{{ $category->active }}</td>
                                <td>
                                    <form action="{{ route('category.delete', $category->slug) }}" style="display: inline-block" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-labeled btn-labeled-start btn-sm" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
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
    <x-select2-js></x-select2-js>
@endsection
