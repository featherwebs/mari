@extends('layouts.app')

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.css" rel="stylesheet">
    <style>
        .thumbnail-wrapper {
            position: relative;
            text-align: center;
        }

        .thumbnail-wrapper.selected, .thumbnail-wrapper:hover {
            border: 1px solid rgba(105, 105, 230, 0.8);
        }

        .thumbnail-wrapper input {
            position: absolute;
            right: 10px;
        }

        .thumbnail-wrapper, .thumbnail-wrapper img {
            width: 100%;
        }
    </style>
@endpush

@section('content')

    @component('layouts.admin-template')
        @slot('heading')
            Media
        @endslot
        <form action="{{ route('admin.media.show','all') }}">
            <div class="row">
                <label class="col-sm-1" for="action">Action</label>
                <div class="col-sm-2">
                    <select id="action" name="action" class="form-control changeToSubmit">
                        <option value="">Select an Action</option>
                        <option value="edit">Edit</option>
                        <option value="delete">Delete</option>
                    </select>
                </div>
                <div class="col-sm-1 text-right col-sm-offset-8">
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addModal">
                        <i class="fa fa-plus"></i>
                        Add
                    </button>
                </div>
            </div>
            <br>
            @forelse($medias->chunk(6) as $chunk)
                <div class="row">
                    @foreach($chunk as $key => $media)
                        <div class="col-sm-2">
                            <div class="panel panel-default thumbnail-wrapper">
                                <label>
                                    <input type="checkbox" name="image[]" value="{{ $media->id }}">
                                    <img src="{{ $media->getThumbnail(150,150) }}" class="img-responsive">
                                    <span class="thumbnail-title">
                                        {!! empty($media->meta) ? '<i>[NONE]</i>': '['.$media->meta.']' !!}<br>
                                        {{ str_limit($media->getCustom('title'), 15) }}
                                    </span>
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            @empty
                <div class="alert alert-callout alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p class="text-capitalize">no media available</p>
                </div>
            @endforelse
        </form>
    @endcomponent
    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="AddModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <form class="mydropzone" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}
                        Drop file here or click
                        <div class="fallback">
                            <input name="file" type="file" multiple />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-primary btn-edit hidden">Proceed to Edit</a>
                    <a href="{{ route('admin.media.index') }}" class="btn btn-default">Done</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js"></script>
    <script type="text/javascript">
        var uploadedIds = [];

        $(document).ready(function () {
            $('.mydropzone').dropzone({
                paramName: "file",
                maxFilesize: 20,
                url: "{{ route('admin.media.store') }}",
                uploadMultiple: false,
                maxFiles: 20,
                init: function () {
                    this.on("success", function (file, response) {
                        uploadedIds.push(response);
                        $('.btn-edit').removeClass('hidden');
                    });
                }
            });
            $('.btn-edit').click(function () {
                var params = "";
                for (var i in uploadedIds) {
                    params += "image[]=" + uploadedIds[i] + '&';
                }
                window.open('/admin/media/all?action=edit&' + params, '_parent');
            });

            $('.changeToSubmit').val('');
            $('.changeToSubmit').change(function () {
                $(this).closest('form').submit();
            });
            $('.thumbnail-wrapper input').change(function () {
                if ($(this).is(':checked'))
                    $(this).closest('.thumbnail-wrapper').addClass('selected');
                else
                    $(this).closest('.thumbnail-wrapper').removeClass('selected');
            });
        });
    </script>
@endpush