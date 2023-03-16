@extends('layouts.admin.main')
@push('title')
    <title>Admin - {{ $product->id != null ? 'Edit Product' : 'Add New Product' }}</title>
@endpush
@section('vendor-styles')
    <x-data-table-css></x-data-table-css>
    <x-select2-css></x-select2-css>
@endsection
@section('custom-page-styles')
    <style>
        .media-wrapper {
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

        .media-container:hover {
            opacity: 0.5;
        }

        .nodisplay {
            display: none;
        }
    </style>
@endsection
@push('content-heading')
    <x-content-heading pageHeading="{{ $product->id != null ? 'Edit Product' : 'Add New Product' }}" showBredCrumb="true"></x-content-heading>
@endpush
@section('admin-main')
    <form action="{{ $product->id == null ? route('product.save') : route('product.update', $product->id) }}" method="POST" style="display: inline-block; width: 100%; padding: 0; margin: 0; box-sizing: border-box;">
        @csrf
        @if ($product->id != null)
            @method('PUT')
        @endif
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product Name</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="title" placeholder="Enter Product Name" value="{{ old('title', $product->title) }}" required>
                                @error('title')
                                    <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product Description</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <textarea class="form-control" name="desc">{{ old('desc', $product->desc) }}</textarea>
                                @error('desc')
                                    <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product Attribtes</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @foreach ($attributes as $attribute)
                                <div class="row attribute-wrapper">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input product-attribute" data-slug="{{ $attribute->slug }}" name="attributes[]" type="checkbox" value="{{ $attribute->id }}" {{ $product->hasAttr($attribute->slug) ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ $attribute->name }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8 {{ $product->hasAttr($attribute->slug) ? '' : 'nodisplay' }}" id="terms-wrapper-{{ $attribute->slug }}">
                                        <div class="form-group">
                                            <div class="select2-purple">
                                                <select id="terms-of-{{ $attribute->slug }}" class="select2" name="terms[]" multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                    @foreach ($attribute->getTerms as $term)
                                                        <option value="{{ $term->id }}" {{ $product->hasTerm($term->slug) ? 'selected' : '' }}>{{ $term->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product Short Description</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <textarea class="form-control" name="short_desc">{{ old('short_desc', $product->short_desc) }}</textarea>
                                @error('short_desc')
                                    <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Publish</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('product.add-new') }}" class="btn btn-warning">Clear</a>
                            <button type="submit" class="btn btn-success product-submit-btn">Submit</button>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product Categories</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="max-height: 300px; overflow: auto;">
                            <div class="form-group">
                                <!-- Recursive way of displaying category -->
                                @include('layouts.inc.category-recursive', ['categories' => $categories, 'margin' => 0, 'product' => $product])
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product Image</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="{{ $product->getThumbnail != null ? $product->getThumbnail->file : '' }}" alt="" id="product-thumbnail" style="width: 100%" data-toggle="modal" data-target="#modal-xl">
                                </div>
                            </div>
                            <input type="hidden" name="thumbnail_id" id="thumbnail">
                        </div>
                        <div class="card-footer">
                            <a href="#" class="text-danger remove-product-image {{ $product->getThumbnail == null ? 'nodisplay' : '' }}">Remove product image</a>
                            <a href="#" class="text-primary set-product-image {{ $product->getThumbnail != null ? 'nodisplay' : '' }}" data-toggle="modal" data-target="#modal-xl">Set product image</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product Gallery</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="">Add product gallery images</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product Tags</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Select Product Image From Library</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="media-wrapper">
                        @foreach ($medias as $media)
                            <div class="media-container" data-src="{{ $media->file }}" data-media-id="{{ $media->id }}">
                                <img src="{{ $media->file }}" class="media-image" />
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('vendor-scripts')
    <x-data-table-js></x-data-table-js>
    <x-select2-js></x-select2-js>
@endsection
@section('custom-page-scripts')
    <script>
        $(document).ready(function() {
            $('.media-container').off('click').on('click', function(e) {
                e.preventDefault();
                var srcUrl = $(this).data('src');
                var mediaId = $(this).data('media-id');

                $('#product-thumbnail').attr('src', srcUrl);
                $('#thumbnail').val(mediaId);
                $('.remove-product-image').removeClass('nodisplay');
                $('.set-product-image').addClass('nodisplay');

                $('#modal-xl').modal('hide');
            })

            $('.remove-product-image').off('click').on('click', function(e) {
                e.preventDefault();
                $('#product-thumbnail').attr('src', "");
                $('#thumbnail').val("");
                $(this).addClass('nodisplay');
                $('.set-product-image').removeClass('nodisplay');
            })

            $('.product-attribute').off('click').on('click', function(e) {
                var attributeSlug = $(this).data('slug');
                if ($(this).is(':checked')) {
                    $('#terms-wrapper-' + attributeSlug).removeClass('nodisplay');
                } else {
                    $('#terms-wrapper-' + attributeSlug).addClass('nodisplay');
                    $('select#terms-of-' + attributeSlug).val([]).change();
                }
            })

        })
    </script>
@endsection
