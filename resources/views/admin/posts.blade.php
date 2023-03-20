@extends('layouts.admin.main')
@push('title')
    <title>Admin - Posts</title>
@endpush
@section('vendor-styles')
    <x-data-table-css></x-data-table-css>
@endsection
@push('content-heading')
    <x-content-heading pageHeading="Posts" showBredCrumb="true"></x-content-heading>
@endpush
@section('admin-main')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of Posts</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped data-table">
                    <thead>
                        <tr>
                            <th data-nosort="Y">Thumbnail</th>
                            <th>Title</th>
                            <th>Short Description</th>
                            <th>Categories</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>
                                    @if ($post->thumbnail != null)
                                        <img src="{{ $post->thumbnail->file }}" alt="" id="post-thumbnail" style="width: 50px; height: 50px;">    
                                    @endif
                                    <p class="text-bold mb-0"><a href="{{ route('post.edit', $post->id) }}">{{ $post->title }}</a></p>
                                    <span>{{ 'ID:' . $post->id }} | <a href="{{ route('post.edit', $post->id) }}" alt="Edit post">Edit</a> | <a href="{{ route('post.trash', $post->id) }}" alt="Trash post">Trash</a></span>
                                </td>
                                <td>{{ $post->short_desc }}</td>
                                <td>
                                    @foreach ($post->categories as $cat)
                                        <li style="display: inline-block; list-style: none; padding: 5px 10px; background: #ddd; border-radius: 5px; font-size: 12px; cursor: pointer; margin-right: 5px;"><a target="_blank" href="{{ route('category.edit', $cat->slug) }}">{{ $cat->name }}</a></li>
                                    @endforeach
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
