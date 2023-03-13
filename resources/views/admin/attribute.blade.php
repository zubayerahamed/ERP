@extends('layouts.admin.main')
@push('title')
    <title>Admin - Attribute</title>
@endpush
@section('vendor-styles')
    <x-data-table-css></x-data-table-css>
@endsection
@push('content-heading')
    <x-content-heading pageHeading="Attribute" showBredCrumb="true"></x-content-heading>
@endpush
@section('admin-main')
    <div class="col-md-4">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Crate Attribute</h3>
            </div>
            <!-- /.card-header -->
            <form id="mainform" action="{{ $attribute->id == null ? route('attribute.save') : route('attribute.update', $attribute->id) }}" method="POST">
                @csrf
                @if ($attribute->id != null)
                    @method('PUT')
                @endif

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Attribute Name" value="{{ old('name', $attribute->name) }}" required>
                        @error('name')
                            <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" name="slug" value="{{ old('slug', $attribute->slug) }}" placeholder="Enter Attribute Slug" {{ $attribute->id != null ? 'readonly' : '' }}>
                    </div>
                    <div class="form-group">
                        <label for="seqn">Sequence</label>
                        <input type="number" class="form-control" name="seqn" placeholder="Sequence" min="0" step="1" value="{{ old('seqn', $attribute->seqn == null ? 0 : $attribute->seqn) }}">
                        @error('seqn')
                            <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="active" {{ $attribute->id == null || $attribute->active ? 'checked' : '' }}>
                            <label for="customCheckbox2" class="custom-control-label">Active?</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('attribute.page') }}" class="btn btn-warning">Clear</a>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of Attributes</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Sequence</th>
                            <th>Terms</th>
                            <th class="text-center">Active Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attributes as $attribute)
                            <tr>
                                <td><a href="{{ route('attribute.edit', $attribute->slug) }}">{{ $attribute->name }}</a></td>
                                <td>{{ $attribute->seqn }}</td>
                                <td>
                                    <a href="{{ route('term.page', $attribute->id) }}">Configure terms</a>
                                </td>
                                <td class="text-center">
                                    @if ($attribute->active)
                                        <p class="text-success text-bold">Active</p>
                                    @else
                                        <p class="text-danger text-bold">Inactive</p>
                                    @endif
                                </td>
                                {{-- <td class="text-right">
                                    <form action="{{ route('attribute.trash', $attribute->slug) }}" style="display: inline-block" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-labeled btn-labeled-start btn-sm category-delete" title="Trash">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td> --}}
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
    <script>
        
    </script>
@endsection
