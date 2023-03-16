@extends('layouts.admin.main')
@push('title')
    <title>Admin - Media</title>
@endpush
@section('vendor-styles')
    <x-data-table-css></x-data-table-css>
@endsection
@section('custom-page-styles')
    <style>
        .media-wrapper{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .media-container {
            width: 150px;
            height: 150px;
            padding: 10px;
            margin: 10px;
            border: 1px dotted rgb(87, 86, 86);
            background: #fff;
            box-sizing: border-box;
            float: left;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0px 0px 5px #ddd;
            cursor: pointer;
        }

        .media-container>img {
            width: 100%;
        }

        .media-container:hover{
            opacity: 0.5;
        }
    </style>
@endsection
@push('content-heading')
    <x-content-heading pageHeading="Media" showBredCrumb="true"></x-content-heading>
@endpush
@section('admin-main')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Library</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <div class="media-wrapper">
                    @foreach ($medias as $media)
                        <div class="media-container">
                            <img src="{{ $media->file }}" />
                        </div>
                    @endforeach
                </div>

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
