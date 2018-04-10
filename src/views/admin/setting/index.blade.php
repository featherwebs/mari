@extends('featherwebs::admin.layout')

@section('content')
    <form method="POST" action="{{ route('admin.setting.store') }}" class="form form-validate" role="form" novalidate="novalidate" enctype="multipart/form-data">
        {{ csrf_field() }}
        @component('featherwebs::admin.template.default')
            @slot('heading')
                <h2 class="mdl-card__title-text">Settings</h2>
            @endslot
            @slot('tools')
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit">
                    <i class="material-icons">save</i>
                    Save
                </button>
            @endslot
            @slot('breadcrumb')
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Settings</li>
                    </ol>
                </nav>
            @endslot
            <div id="setting-app">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#general" role="tab" data-toggle="tab">General</a></li>
                    <li role="presentation">
                        <a href="#contact" role="tab" data-toggle="tab">Contact</a></li>
                    <li role="presentation">
                        <a href="#social" role="tab" data-toggle="tab">Social</a></li>
                    <li role="presentation">
                        <a href="#custom" role="tab" data-toggle="tab">Custom</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="general">
                        <div class="form-group">
                            <label for="title" class="control-label col-sm-2">Title</label>
                            <div class="col-sm-10">
                                <input type="text" id="title" name="setting[title]" value="{{ old('setting.title') ?: fw_setting('title') }}" class="form-control">
                                <span class="help-block">Site Title</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="control-label col-sm-2">Description</label>
                            <div class="col-sm-10">
                                <textarea id="description" name="setting[description]" class="form-control">{{ old('setting.description') ?: fw_setting('description') }}</textarea>
                                <span class="help-block">Site Description</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="control-label col-sm-2">Address</label>
                            <div class="col-sm-10">
                                <textarea id="address" name="setting[address]" class="form-control">{{ old('setting.address') ?: fw_setting('address') }}</textarea>
                                <span class="help-block">Notificatins will be sent to this email.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="notification-emails" class="control-label col-sm-2">Notification Email</label>
                            <div class="col-sm-10">
                                <input type="text" id="notification-emails" name="setting[notification-emails]" value="{{ old('setting.notification-emails') ?: fw_setting('notification-emails') }}" class="form-control">
                                <span class="help-block">Seperate each email address by <code>comma (,)</code></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="homepage" class="control-label col-sm-2">Homepage</label>
                            <div class="col-sm-10">
                                <select id="homepage" name="setting[homepage]" class="form-control">
                                    @foreach($pages as $id => $page)
                                        <option value="{{ $id }}"{{ fw_setting('homepage') == $id ? ' selected':'' }}>{{ $page }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">Notificatins will be sent to this email.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="logo" class="control-label col-sm-2">Logo</label>
                            <div class="col-sm-10">
                                <image-selector name="setting[logo]" value="{{ fw_setting('logo') }}" />
                                <span class="help-block">Main Logo</span>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="contact">
                        <div class="form-group">
                            <label for="phone" class="control-label col-sm-2">Phone</label>
                            <div class="col-sm-10">
                                <textarea id="phone" name="setting[phone]" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label col-sm-2">Email</label>
                            <div class="col-sm-10">
                                <input type="text" id="email" name="setting[email]" value="{{ old('setting.email') ?: fw_setting('email') }}" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="postbox" class="control-label col-sm-2">Post Box</label>
                            <div class="col-sm-10">
                                <input type="text" id="postbox" name="setting[postbox]" value="{{ old('setting.postbox') ?: fw_setting('postbox') }}" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="postbox" class="control-label col-sm-2">Longitude</label>
                            <div class="col-sm-10">
                                <input type="text" id="postbox" name="setting[longitude]" value="{{ old('setting.longitude') ?: fw_setting('longitude') }}" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="postbox" class="control-label col-sm-2">Latitude</label>
                            <div class="col-sm-10">
                                <input type="text" id="postbox" name="setting[latitude]" value="{{ old('setting.latitude') ?: fw_setting('latitude') }}" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="social">
                        <div class="form-group">
                            <label for="facebook" class="control-label col-sm-2">Facebook</label>
                            <div class="col-sm-10">
                                <input type="text" id="facebook" name="setting[facebook]" value="{{ old('setting.facebook') ?: fw_setting('facebook') }}" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="twitter" class="control-label col-sm-2">Twitter</label>
                            <div class="col-sm-10">
                                <input type="text" id="twitter" name="setting[twitter]" value="{{ old('setting.twitter') ?: fw_setting('twitter') }}" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="google_plus" class="control-label col-sm-2">Google Plus</label>
                            <div class="col-sm-10">
                                <input type="text" id="google_plus" name="setting[google_plus]" value="{{ old('setting.google_plus') ?: fw_setting('google_plus') }}" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="custom">
                        @forelse($settings as $setting)
                            <div class="form-group">
                                <label for="{{ $setting->slug }}" class="control-label col-sm-2">{{ $setting->slug }}</label>
                                <div class="col-sm-9">
                                    <textarea id="{{ $setting->slug }}" name="setting[{{ $setting->slug }}]" class="form-control">{{ old('setting.'.$setting->slug) ?: fw_setting($setting->slug) }}</textarea>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-sm-1">
                                    <button class="btn btn-danger btn-xs btn-delete" data-url="{{ route('admin.setting.destroy', $setting->id) }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="form-group">
                                <div class="col-xs-12">
                                    No Custom Fields. Add one?
                                </div>
                            </div>
                        @endforelse
                        <div class="form-group">
                            <div class="col-xs-12">
                                <button class="btn btn-primary pull-right" type="button" data-toggle="modal" data-target="#addModal">
                                    <i class="fa fa-plus"></i>
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcomponent
    </form>
    <form method="POST" action="{{ route('admin.setting.store') }}">
        {{ csrf_field() }}
        <div class="modal fade" tabindex="-1" role="dialog" id="addModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add Custom Field</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="slug" class="control-label col-sm-2">Slug</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="slug" name="newsetting[slug]" class="form-control">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="value" class="control-label col-sm-2">Value</label>
                                    <div class="col-sm-10">
                                        <textarea id="value" name="newsetting[value]" class="form-control"></textarea>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form method="POST" id="delete-form">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.btn-delete', function (e) {
                e.preventDefault();

                var url = $(this).data('url');
                if(url) {
                    if(confirm('Are you sure?')) {
                        $form = $('#delete-form');
                        $form.attr('action', url);
                        $form.submit();
                    }
                } else {
                    alert('Something went wrong!')
                }
            });
        });
    </script>
    <script src="{{ asset('/vendor/laravel-filemanager/js/lfm.js') }}"></script>
    <script type="text/javascript">
        @php
            include base_path().'/vendor/featherwebs/mari/src/public/js/dist/setting.js';
        @endphp
    </script>
@endpush