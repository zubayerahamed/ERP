@extends('layouts.admin.main')
@push('title')
    <title>Admin - {{ $post->id != null ? 'Edit Post' : 'Add New Post' }}</title>
@endpush
@section('vendor-styles')
    <!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js) -->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.css">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.css">

    <!-- summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
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
    <x-content-heading pageHeading="{{ $post->id != null ? 'Edit Post' : 'Add New Post' }}" showBredCrumb="true"></x-content-heading>
@endpush
@section('admin-main')
    <form action="{{ $post->id == null ? route('post.save') : route('post.update', $post->id) }}" method="POST" style="display: inline-block; width: 100%; padding: 0; margin: 0; box-sizing: border-box;">
        @csrf
        @if ($post->id != null)
            @method('PUT')
        @endif
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Post Title</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="title" placeholder="Enter Post Title" value="{{ old('title', $post->title) }}" required>
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
                            <h3 class="card-title">Post Description</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <textarea class="form-control summernote" name="desc" rows="10">{{ old('desc', $post->desc) }}</textarea>
                                @error('desc')
                                    <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Post Short Description</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <textarea class="form-control" name="short_desc" id="editor">{{ old('short_desc', $post->short_desc) }}</textarea>
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
                            <a href="{{ route('post.add-new') }}" class="btn btn-warning">Clear</a>
                            <button type="submit" class="btn btn-success post-submit-btn">Submit</button>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Post Categories</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="max-height: 300px; overflow: auto;">
                            <div class="form-group">
                                <!-- Recursive way of displaying category -->
                                @include('layouts.inc.post-category-recursive', ['categories' => $categories, 'margin' => 0, 'post' => $post])
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="text-primary create-new-category-link" data-toggle="modal" data-target="#category-create-modal">Add New Category</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Post Image</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="{{ $post->thumbnail != null ? $post->thumbnail->file : '' }}" alt="" id="post-thumbnail" style="width: 100%" data-toggle="modal" data-target="#modal-xl">
                                </div>
                            </div>
                            <input type="hidden" name="thumbnail_id" id="thumbnail" value="{{ old('thumbnail_id', $post->thumbnail_id) }}">
                        </div>
                        <div class="card-footer">
                            <a href="#" class="text-danger remove-post-image {{ $post->getThumbnail == null ? 'nodisplay' : '' }}">Remove Thumbnail</a>
                            <a href="#" class="text-primary set-post-image {{ $post->getThumbnail != null ? 'nodisplay' : '' }}" data-toggle="modal" data-target="#modal-xl">Set Thumbnail</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Post Tags</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                        </div>
                        <div class="card-footer">
                            <a href="#" class="text-primary" data-toggle="modal" data-target="#tag-modal">Add New Tag</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>



    <div class="modal fade" id="category-create-modal">
        <div class="modal-dialog modal-m">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="category-create-from-wrapper">
                        category form
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




    <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Select Post Image From Library</h4>
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
    <!-- CodeMirror -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/2.36.0/formatting.js"></script>

    <!-- Summernote -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
@endsection
@section('custom-page-scripts')
    <script>
        $(document).ready(function() {

            $('.create-new-category-link').off('click').on('click', function(e) {
                
                loadingMask2.show();
                $.ajax({
                    url: '{{ route('category.form') }}',
                    type: 'GET',
                    success: function(data) {
                        loadingMask2.hide();
                        $('.category-create-from-wrapper').html("");
                        $('#create-new-category-modal').modal('show');
                        $('.category-create-from-wrapper').append(data);
                    },
                    error: function(jqXHR, status, errorThrown) {
                        loadingMask2.hide();
                    }
                });

            })


            $('.summernote').summernote({
                tabsize: 2,
                height: 300,
                codemirror: {
                    theme: 'monokai'
                },
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            })

            // CodeMirror
            if ($('#codeMirrorDemo').length > 0) {
                CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                    mode: "htmlmixed",
                    theme: "monokai"
                });
            }

            $('.media-container').off('click').on('click', function(e) {
                e.preventDefault();
                var srcUrl = $(this).data('src');
                var mediaId = $(this).data('media-id');

                $('#post-thumbnail').attr('src', srcUrl);
                $('#thumbnail').val(mediaId);
                $('.remove-post-image').removeClass('nodisplay');
                $('.set-post-image').addClass('nodisplay');

                $('#modal-xl').modal('hide');
            })

            $('.remove-post-image').off('click').on('click', function(e) {
                e.preventDefault();
                $('#post-thumbnail').attr('src', "");
                $('#thumbnail').val("");
                $(this).addClass('nodisplay');
                $('.set-post-image').removeClass('nodisplay');
            })

            $('.post-attribute').off('click').on('click', function(e) {
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
