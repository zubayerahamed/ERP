@extends('layouts.admin.main')
@push('title')
    <title>Admin - Capability</title>
@endpush
@push('content-heading')
    <x-content-heading pageHeading="Capability" showBredCrumb="true"></x-content-heading>
@endpush
@section('admin-main')
    <div class="col-md-4">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Crate Capability for group <b><a href="{{ route('cg.edit', $capabilityGroup->id) }}">{{ $capabilityGroup->name }}</a></b></h3>
            </div>
            <!-- /.card-header -->
            <form id="mainform" action="{{ $capability->id == null ? route('capability.save') : route('capability.update', $capability->id) }}" method="POST">
                @csrf
                @if ($capability->id != null)
                    @method('PUT')
                @endif

                <input type="hidden" name="capability_group_id" value="{{ $capabilityGroup->id }}"/>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Capability Name" value="{{ old('name', $capability->name) }}" required>
                        @error('name')
                            <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="seqn">Sequence</label>
                        <input type="number" class="form-control" name="seqn" placeholder="Sequence" min="0" step="1" value="{{ old('seqn', $capability->seqn == null ? 0 : $capability->seqn) }}">
                        @error('seqn')
                            <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('capability.page', $capabilityGroup->id) }}" class="btn btn-warning">Clear</a>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of Capabilities</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Sequence</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($capabilities as $capability)
                            <tr>
                                <td><a href="{{ route('capability.edit', $capability->slug) }}">{{ $capability->name }}</a></td>
                                <td>{{ $capability->seqn }}</td>
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
