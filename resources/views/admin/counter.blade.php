@extends('layouts.admin.main')
@push('title')
    <title>Admin - Counter</title>
@endpush
@section('vendor-styles')
    <x-data-table-css></x-data-table-css>
@endsection
@push('content-heading')
    <x-content-heading pageHeading="Counter" showBredCrumb="false"></x-content-heading>
@endpush
@section('admin-main')
    <div class="col-md-4">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Crate Counter for Shop <b><a href="{{ route('shop.edit', $shop->slug) }}">{{ $shop->name }}</a></b></h3>
            </div>
            <!-- /.card-header -->
            <form id="mainform" action="{{ $counter->id == null ? route('counter.save') : route('counter.update', $counter->id) }}" method="POST">
                @csrf
                @if ($counter->id != null)
                    @method('PUT')
                @endif

                <input type="hidden" name="shop_id" value="{{ $shop->id }}"/>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Counter Name" value="{{ old('name', $counter->name) }}" required>
                        @error('name')
                            <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" name="slug" value="{{ old('slug', $counter->slug) }}" placeholder="Enter Counter Slug" {{ $counter->id != null ? 'readonly' : '' }}>
                    </div>
                    <div class="form-group">
                        <label for="seqn">Sequence</label>
                        <input type="number" class="form-control" name="seqn" placeholder="Sequence" min="0" step="1" value="{{ old('seqn', $counter->seqn == null ? 0 : $counter->seqn) }}">
                        @error('seqn')
                            <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="active" {{ $counter->id == null || $counter->active ? 'checked' : '' }}>
                            <label for="customCheckbox2" class="custom-control-label">Active?</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('counter.page', $shop->id) }}" class="btn btn-warning">Clear</a>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of counters</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Sequence</th>
                            <th class="text-center">Active Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($counters as $counter)
                            <tr>
                                <td><a href="{{ route('counter.edit', $counter->slug) }}">{{ $counter->name }}</a></td>
                                <td>{{ $counter->seqn }}</td>
                                <td class="text-center">
                                    @if ($counter->active)
                                        <p class="text-success text-bold">Active</p>
                                    @else
                                        <p class="text-danger text-bold">Inactive</p>
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
    <script>
        
    </script>
@endsection
