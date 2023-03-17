@extends('layouts.admin.main')
@push('title')
    <title>Admin - Outlet</title>
@endpush
@section('vendor-styles')
    <x-data-table-css></x-data-table-css>
@endsection
@push('content-heading')
    <x-content-heading pageHeading="Outlet" showBredCrumb="false"></x-content-heading>
@endpush
@section('admin-main')
    <div class="col-md-4">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Crate Outlet for Business <b><a href="{{ route('business.edit', $business->slug) }}">{{ $business->name }}</a></b></h3>
            </div>
            <!-- /.card-header -->
            <form id="mainform" action="{{ $outlet->id == null ? route('outlet.save') : route('outlet.update', $outlet->id) }}" method="POST">
                @csrf
                @if ($outlet->id != null)
                    @method('PUT')
                @endif

                <input type="hidden" name="business_id" value="{{ $business->id }}"/>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Outlet Name" value="{{ old('name', $outlet->name) }}" required>
                        @error('name')
                            <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" name="slug" value="{{ old('slug', $outlet->slug) }}" placeholder="Enter Outlet Slug" {{ $outlet->id != null ? 'readonly' : '' }}>
                    </div>
                    <div class="form-group">
                        <label for="seqn">Sequence</label>
                        <input type="number" class="form-control" name="seqn" placeholder="Sequence" min="0" step="1" value="{{ old('seqn', $outlet->seqn == null ? 0 : $outlet->seqn) }}">
                        @error('seqn')
                            <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="active" {{ $outlet->id == null || $outlet->active ? 'checked' : '' }}>
                            <label for="customCheckbox2" class="custom-control-label">Active?</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('outlet.page', $business->id) }}" class="btn btn-warning">Clear</a>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of Outlets</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Sequence</th>
                            <th>Shops</th>
                            <th class="text-center">Active Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($outlets as $outlet)
                            <tr>
                                <td><a href="{{ route('outlet.edit', $outlet->slug) }}">{{ $outlet->name }}</a></td>
                                <td>{{ $outlet->seqn }}</td>
                                <td style="font-size: 12px">
                                    @foreach ($outlet->shops as $shop)
                                        <li style="display: inline-block; list-style: none; padding: 5px 10px; background: #ddd; border-radius: 5px; cursor: pointer; margin-right: 5px;"><a href="{{ route('shop.edit', $shop->slug) }}">{{ $shop->name }}</a></li>
                                    @endforeach
                                    <br/>
                                    <br/>
                                    <a href="{{ route('shop.page', $outlet->id) }}">Configure Shop</a>
                                </td>
                                <td class="text-center">
                                    @if ($outlet->active)
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
