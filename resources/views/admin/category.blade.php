@extends('layouts.admin.main')
@push('title')
    <title>Admin - Category</title>
@endpush
@section('custom-page-styles')
    <style>
        .avatar-input {
            display: none !important;
        }

        .avatar-img:hover {
            opacity: 0.2 !important;
            cursor: pointer;
        }

        #avatar-image {
            display: block;
            max-width: 100%;
        }

        .preview {
            text-align: center;
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 0 auto;
            border: 1px solid red;
        }

        .section {
            margin-top: 150px;
            background: #fff;
            padding: 50px 30px;
        }
    </style>
@endsection
@push('content-heading')
    <x-content-heading pageHeading="Category" showBredCrumb="true"></x-content-heading>
@endpush
@section('admin-main')
    <div class="col-md-4">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Crate Category</h3>
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
                                <option value="{{ $cat->id }}" {{ $category->parentCategory != null && $category->parentCategory->id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="seqn">Sequence</label>
                        <input type="number" class="form-control" name="seqn" placeholder="Sequence" min="0" step="1" value="{{ old('seqn', $category->seqn == null ? 0 : $category->seqn) }}">
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="active" {{ $category->id == null || $category->active ? 'checked' : '' }}>
                            <label for="customCheckbox2" class="custom-control-label">Active?</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('category.page') }}" class="btn btn-warning">Clear</a>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
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
                            <th data-nosort="Y">Image</th>
                            <th>Name</th>
                            <th>Parent</th>
                            <th>Sequence</th>
                            <th class="text-center">Active Status</th>
                            <th data-nosort="Y" class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    <div>
                                        <img class="avatar-img" src="{{ $category->image }}" style="width: 50px; height: 50px;" alt="">
                                        <input type="file" name="image" class="form-control avatar-input" id="{{ $category->id }}" accept="image/*">
                                    </div>
                                </td>
                                <td><a href="{{ route('category.edit', $category->slug) }}">{{ $category->name }}</a></td>
                                <td>
                                    @if ($category->parentCategory != null)
                                        <a href="{{ route('category.edit', $category->parentCategory->slug) }}">{{ $category->parentCategory->name }}</a>
                                    @endif
                                </td>
                                <td>{{ $category->seqn }}</td>
                                <td class="text-center">
                                    @if ($category->active)
                                        <p class="text-success text-bold">Active</p>
                                    @else
                                        <p class="text-danger text-bold">Inactive</p>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <form action="{{ route('category.delete', $category->slug) }}" style="display: inline-block" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-labeled btn-labeled-start btn-sm category-delete" title="Delete">
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


    <div id="avatar-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crop & Resize your image</h5>
                </div>

                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img id="avatar-image" src="">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger crop-cancel" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-page-scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.category-delete', function(e) {
                e.preventDefault();
                if (confirm('Are you want to delete this item?')) {
                    $(this).parents('form').submit();
                }
            });

            $('.avatar-img').off('click').on('click', function(e) {
                e.preventDefault();
                $(this).siblings(".avatar-input:hidden").trigger('click');
            });

            var dreamId;
            var $modal = $('#avatar-modal');
            var image = document.getElementById('avatar-image');
            var cropper;

            $("body").on("change", ".avatar-input", function(e) {

                dreamId = e.target.id;
                var files = e.target.files;
                var done = function(url) {
                    image.src = url;
                    $modal.modal('show');
                };

                var reader;
                var file;
                var url;

                if (files && files.length > 0) {
                    file = files[0];

                    if (URL) {
                        done(URL.createObjectURL(file));
                    } else if (FileReader) {
                        reader = new FileReader();
                        reader.onload = function(e) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });

            // Init cropper js when modal show and destroy cropper js when modal hide
            $modal.on('shown.bs.modal', function() {
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 3,
                    preview: '.preview'
                });
            }).on('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
            });


            $('.crop-cancel').off('click').on('click', function() {
                $modal.modal('hide');
            });

            $("#crop").click(function() {
                canvas = cropper.getCroppedCanvas({
                    width: 160,
                    height: 160,
                });

                canvas.toBlob(function(blob) {
                    url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        var base64data = reader.result;
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: $('.adminBasePath').attr('href') + "/category/image/" + dreamId,
                            data: {
                                '_token': $('meta[name="_token"]').attr('content'),
                                'image': base64data
                            },
                            success: function(data) {
                                $modal.modal('hide');
                                showMessage('success', data.success);
                                setTimeout(() => {
                                    location.reload();
                                }, 1000);
                            }
                        });
                    }
                });
            });
        })
    </script>
@endsection
