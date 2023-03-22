@extends('layouts.admin.main')
@push('title')
    <title>Admin - Business</title>
@endpush
@push('content-heading')
    <x-content-heading pageHeading="Business" showBredCrumb="true"></x-content-heading>
@endpush
@section('admin-main')
    <div class="col-md-4">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Crate Business</h3>
            </div>
            <!-- /.card-header -->
            <form id="mainform" action="{{ $business->id == null ? route('business.save') : route('business.update', $business->id) }}" method="POST">
                @csrf
                @if ($business->id != null)
                    @method('PUT')
                @endif

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Business Name" value="{{ old('name', $business->name) }}" required>
                        @error('name')
                            <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" name="slug" value="{{ old('slug', $business->slug) }}" placeholder="Enter Business Slug" {{ $business->id != null ? 'readonly' : '' }}>
                    </div>
                    <div class="form-group">
                        <label for="seqn">Sequence</label>
                        <input type="number" class="form-control" name="seqn" placeholder="Sequence" min="0" step="1" value="{{ old('seqn', $business->seqn == null ? 0 : $business->seqn) }}">
                        @error('seqn')
                            <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="active" {{ $business->id == null || $business->active ? 'checked' : '' }}>
                            <label for="customCheckbox2" class="custom-control-label">Active?</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('business.page') }}" class="btn btn-warning">Clear</a>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of Businesss</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Sequence</th>
                            <th>Outlets</th>
                            <th class="text-center">Active Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($businesses as $business)
                            <tr>
                                <td><a href="{{ route('business.edit', $business->slug) }}">{{ $business->name }}</a></td>
                                <td>{{ $business->seqn }}</td>
                                <td style="font-size: 12px">
                                    @foreach ($business->outlets as $term)
                                        <li style="display: inline-block; list-style: none; padding: 5px 10px; background: #ddd; border-radius: 5px; cursor: pointer; margin-right: 5px;"><a href="{{ route('outlet.edit', $term->slug) }}">{{ $term->name }}</a></li>
                                    @endforeach
                                    <br/>
                                    <br/>
                                    <a href="{{ route('outlet.page', $business->id) }}">Configure Outlets</a>
                                </td>
                                <td class="text-center">
                                    @if ($business->active)
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
