@extends('layouts.admin.main')
@push('title')
    <title>Admin - Capability Group</title>
@endpush
@push('content-heading')
    <x-content-heading pageHeading="Capability Group" showBredCrumb="true"></x-content-heading>
@endpush
@section('admin-main')
    <div class="col-md-4">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Crate Capability Group</h3>
            </div>
            <!-- /.card-header -->
            <form id="mainform" action="{{ $cg->id == null ? route('cg.save') : route('cg.update', $cg->id) }}" method="POST">
                @csrf
                @if ($cg->id != null)
                    @method('PUT')
                @endif

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Group Name" value="{{ old('name', $cg->name) }}" required>
                        @error('name')
                            <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="seqn">Sequence</label>
                        <input type="number" class="form-control" name="seqn" placeholder="Sequence" min="0" step="1" value="{{ old('seqn', $cg->seqn == null ? 0 : $cg->seqn) }}">
                        @error('seqn')
                            <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('cg.page') }}" class="btn btn-warning">Clear</a>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of Groups</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Sequence</th>
                            <th>Capabilities</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cges as $cg)
                            <tr>
                                <td><a href="{{ route('cg.edit', $cg->id) }}">{{ $cg->name }}</a></td>
                                <td>{{ $cg->seqn }}</td>
                                <td style="font-size: 12px">
                                    @foreach ($cg->capabilities as $cap)
                                        <li style="display: inline-block; list-style: none; padding: 5px 10px; background: #ddd; border-radius: 5px; cursor: pointer; margin-right: 5px;"><a href="{{ route('capability.edit', $cap->slug) }}">{{ $cap->name }}</a></li>
                                    @endforeach
                                    <br/>
                                    <br/>
                                    <a href="{{ route('capability.page', $cg->id) }}">Configure Capabilities</a>
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
