@extends('featherwebs::admin.layout')

@section('title', 'Media')

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

        .dropzone {
            border: 2px dashed rgba(0, 0, 0, 0.3);
        }
    </style>
@endpush

@section('content')
    {{--
    @component('featherwebs::admin.template.default')
        @slot('heading')
            <h2 class="mdl-card__title-text">Media</h2>
        @endslot
        @slot('breadcrumb')
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Media</li>
                </ol>
            </nav>
        @endslot
        <form action="{{ route('admin.media.show','all') }}">
            <div class="row">
                <label class="col-sm-1" for="action">Action</label>
                <div class="col-sm-2">
                    <select id="action" name="action" class="form-control changeToSubmit">
                        <option value="">Select an Action</option>
                        <option value="edit">View/Edit</option>
                        <option value="delete">Delete</option>
                    </select>
                </div>
                <div class="col-sm-1 text-right col-sm-offset-8">
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="button" data-toggle="modal" data-target="#addModal">
                        <i class="fa fa-plus"></i>
                        Add
                    </button>
                </div>
            </div>
            <br>
            @forelse($medias as $media)
                <div class="col-md-2 gallery-image-checkbox">
                    <input type="checkbox" name="image[]" id="{{$media->getCustom('title')}}" value="{{ $media->id }}">
                    <label for="{{$media->getCustom('title')}}">
                        <div class="gallery-card-image mdl-card mdl-shadow--2dp">
                            <div class="mdl-card__title mdl-card--expand">
                                <img src="{{ $media->getThumbnail(150,150) }}" alt="">
                            </div>
                            <div class="mdl-card__actions">
                            <span class="gallery-card-image__filename">
                                {{ str_limit($media->getCustom('title'), 15) }}
                            </span>
                            </div>
                        </div>
                    </label>
                </div>
            @empty
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
                    <form class="mydropzone dropzone" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}
                        <div class="fallback">
                            <input name="file" accept="image/jpeg,image/png,image/bmp" type="file" multiple />
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
    --}}
    @component('featherwebs::admin.template.default')
        @slot('heading')
            <h2 class="mdl-card__title-text">Media</h2>
        @endslot
        @slot('breadcrumb')
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Media</li>
                </ol>
            </nav>
        @endslot
        <iframe style="height:80vh" src="/mari-filemanager"></iframe>
    @endcomponent
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js"></script>
    <script type="text/javascript">
        var uploadedIds = [];
        Dropzone.autoDiscover = false;
        $(document).ready(function () {
            $('.mydropzone').dropzone({
                paramName: "file",
                maxFilesize: 20,
                url: "{{ route('admin.media.store') }}",
                uploadMultiple: false,
                acceptedFiles: 'image/png, image/jpeg',
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