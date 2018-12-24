@extends('featherwebs::admin.layout')

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.css" rel="stylesheet">
    <style type="text/css">
        #accordion .card-head {
            cursor: n-resize;
        }
    </style>
@endpush

@section('title', 'Media')

@section('content')
    <form method="POST" action="{{ route('admin.media.destroy','all') }}" class="form form-validate" role="form" novalidate="novalidate" id="deleteForm">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        @foreach($medias as $key => $media)
            <input type="hidden" name="ids[]" class="file" value="{{ $media->id }}">
        @endforeach
    </form>
    <form method="POST" action="{{ route('admin.media.update','all') }}" class="form form-validate" role="form" novalidate="novalidate" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        @component('featherwebs::admin.template.default')
            @slot('heading')
                <h2 class="mdl-card__title-text">Media</h2>
            @endslot
            @slot('tools')
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored btn-deleteall" type="button">
                    <i class="fa fa-trash"></i>
                    Delete All
                </button>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit">
                    <i class="fa fa-save"></i>
                    Save
                </button>
            @endslot
            @slot('breadcrumb')
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.media.index') }}">Media</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            @endslot
            <div class="panel-group" id="accordion">
                @forelse($medias as $key => $media)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="javascript:void(0);">
                                    <div class="row">
                                        <div class="col-sm-1">{{ $media->id }}</div>
                                        <div class="col-sm-1">
                                            <img src="{{ $media->thumbnail }}" class="img-circle img-responsive width-1" alt="Media Image" />
                                        </div>
                                        <div class="col-sm-3">
                                            {!! $media->getCustom('title') ? str_limit($media->getCustom('title'), 25): "<i>Untitled</i>" !!}
                                        </div>
                                        <div class="col-sm-2">
                                            {{ $media->path }}
                                        </div>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <img id="media--{{ $media->id }}" src="{{ $media->thumbnail }}" class="main-thumb img-responsive" alt="media_image" width="300" height="300">
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <input type="file" name="image[{{ $media->id }}][image]" class="file" data-id="{{ $media->id }}" accept="image/jpeg,image/png,image/bmp" data-msg="Invalid!">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" name="image[{{ $media->id }}][custom][title]" value="{{ $media->getCustom('title') }}" class="form-control input-sm">
                                                    <p class="help-block">Recommended 30 Characters</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Caption</label>
                                                    <textarea name="image[{{ $media->id }}][custom][caption]" class="form-control input-sm">{{ $media->getCustom('caption') }}</textarea>
                                                    <p class="help-block">Recommended 30 Characters</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Alt Text</label>
                                                    <input type="text" name="image[{{ $media->id }}][custom][alt]" value="{{ $media->getCustom('alt') }}" class="form-control input-sm">
                                                    <p class="help-block">Recommended 30 Characters</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea name="image[{{ $media->id }}][custom][description]" class="form-control input-sm">{{ $media->getCustom('description') }}</textarea>
                                                    <p class="help-block">Recommended 30 Characters</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Link URL</label>
                                                    <input type="text" name="link[{{ $media->id }}]" value="{{ $media->url }}" class="form-control input-sm" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-callout alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class="text-capitalize">no medias available</p>
                    </div>
                @endforelse
            </div>
        @endcomponent
    </form>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
    <script type="text/javascript">
        function readURL(input) {
            var imgId = $(input).data("id");
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var $image = $("#media--" + imgId);
                    $image.attr("src", e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function () {
            $(".file").change(function () {
                readURL(this);
            });
            $('.main-thumb').click(function () {
                $(this).closest('.panel').find('input[type=file]').trigger('click');
            });
            $('.btn-deleteall').click(function () {
                if (confirm('Are you sure you want to delete the selected image(s)?')) {
                    $('#deleteForm').submit();
                }
            });
            @if(request('action') == 'delete')
            $('.btn-deleteall').trigger('click');
            @endif
        });
    </script>
@endpush