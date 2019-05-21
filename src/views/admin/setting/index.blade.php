@extends('featherwebs::admin.layout')

@section('title', 'Settings')

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
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Settings</li>
                    </ol>
                </nav>
            @endslot
            <div id="setting-app">
                <!-- Nav tabs -->
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs" role="tablist" style="margin-bottom: 25px;">
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
                                <div class="row">
                                    <label for="logo" class="control-label col-sm-2">Logo</label>
                                    <div class="col-sm-4">
                                        <image-selector name="images[logo]" value="{{ fw_setting('logo') }}"></image-selector>
                                        <div class="help-block"><code>fw_setting('logo')</code></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="title" class="control-label col-sm-2">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="title" name="setting[title]" value="{{ old('setting.title') ?: fw_setting('title') }}" class="form-control">
                                        <span class="help-block">Site Title<code>fw_setting('title')</code></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="description" class="control-label col-sm-2">Description</label>
                                    <div class="col-sm-10">
                                        <textarea id="description" name="setting[description]" class="form-control">{{ old('setting.description') ?: fw_setting('description') }}</textarea>
                                        <span class="help-block">Site Description<code>fw_setting('description')</code></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="keywords" class="control-label col-sm-2">Keywords</label>
                                    <div class="col-sm-10">
                                        <textarea id="keywords" name="setting[keywords]" class="form-control">{{ old('setting.keywords') ?: fw_setting('keywords') }}</textarea>
                                        <span class="help-block">Site Keywords<code>fw_setting('keywords')</code></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="address" class="control-label col-sm-2">Address</label>
                                    <div class="col-sm-10">
                                        <textarea id="address" name="setting[address]" class="form-control">{{ old('setting.address') ?: fw_setting('address') }}</textarea>
                                        <span class="help-block">Address shown in the website<code>fw_setting('address')</code></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="notification-emails" class="control-label col-sm-2">Notification Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="notification-emails" name="setting[notification-emails]" value="{{ old('setting.notification-emails') ?: fw_setting('notification-emails') }}" class="form-control">
                                        <span class="help-block">Seperate each email address by comma<code>fw_notifiables($isAdmin = true)</code></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="google-map-api" class="control-label col-sm-2">Google Map API</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="google-map-api" name="setting[google-map-api]" value="{{ old('setting.google-map-api') ?: fw_setting('google-map-api') }}" class="form-control">
                                        <span class="help-block">Google Map Api once set could be used all over the website<code>fw_setting('google-map-api')</code></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="logo" class="control-label col-sm-2">Image Placeholder</label>
                                    <div class="col-sm-4">
                                        <image-selector name="images[placeholder]" value="{{ fw_setting('placeholder') }}"></image-selector>
                                        <div class="help-block"><code>fw_setting('placeholder')</code></div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="contact">
                                <div class="row">
                                    <label for="phone" class="control-label col-sm-2">Phone</label>
                                    <div class="col-sm-10">
                                        <textarea id="phone" name="setting[phone]" class="form-control">{!! old('setting.phone') ?: fw_setting('phone') !!}</textarea>
                                        <span class="help-block"><code>fw_setting('phone')</code></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="email" class="control-label col-sm-2">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="email" name="setting[email]" value="{{ old('setting.email') ?: fw_setting('email') }}" class="form-control">
                                        <span class="help-block"><code>fw_setting('email')</code></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="postbox" class="control-label col-sm-2">Post Box</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="postbox" name="setting[postbox]" value="{{ old('setting.postbox') ?: fw_setting('postbox') }}" class="form-control">
                                        <span class="help-block"><code>fw_setting('postbox')</code></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="postbox" class="control-label col-sm-2">Longitude</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="postbox" name="setting[longitude]" value="{{ old('setting.longitude') ?: fw_setting('longitude') }}" class="form-control">
                                        <span class="help-block"><code>fw_setting('longitude')</code></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="postbox" class="control-label col-sm-2">Latitude</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="postbox" name="setting[latitude]" value="{{ old('setting.latitude') ?: fw_setting('latitude') }}" class="form-control">
                                        <span class="help-block"><code>fw_setting('latitude')</code></span>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="social">
                                <div class="row">
                                    <label for="facebook" class="control-label col-sm-2">Facebook</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="facebook" name="setting[facebook]" value="{{ old('setting.facebook') ?: fw_setting('facebook') }}" class="form-control">
                                        <span class="help-block"><code>fw_setting('facebook')</code></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="twitter" class="control-label col-sm-2">Twitter</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="twitter" name="setting[twitter]" value="{{ old('setting.twitter') ?: fw_setting('twitter') }}" class="form-control">
                                        <span class="help-block"><code>fw_setting('twitter')</code></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="instagram" class="control-label col-sm-2">Instagram</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="instagram" name="setting[instagram]" value="{{ old('setting.instagram') ?: fw_setting('instagram') }}" class="form-control">
                                        <span class="help-block"><code>fw_setting('instagram')</code></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="google" class="control-label col-sm-2">Google</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="google" name="setting[google]" value="{{ old('setting.google') ?: fw_setting('google') }}" class="form-control">
                                        <span class="help-block"><code>fw_setting('google')</code></span>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="custom">
                                @forelse($settings as $setting)
                                    <div class="row">
                                        <label for="{{ $setting->slug }}" class="control-label col-sm-2">{{ $setting->title ?? $setting->slug }}</label>
                                        <div class="col-sm-9">
                                        @if($setting->type == 'image')
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <image-selector name="images[{{ $setting->slug }}]" value="{{ fw_setting($setting->slug) }}"></image-selector>
                                                    </div>
                                                </div>
                                            @elseif($setting->type == 'text')
                                                <textarea id="{{ $setting->slug }}" name="setting[{{ $setting->slug }}]" class="form-control">{{ old('setting.'.$setting->slug) ?: fw_setting($setting->slug) }}</textarea>
                                            @else
                                                <input type="text" id="{{ $setting->slug }}" name="setting[{{ $setting->slug }}]" class="form-control" value="{{ old('setting.'.$setting->slug) ?: fw_setting($setting->slug) }}">
                                            @endif
                                            <span class="help-block"><code>fw_setting('{{ $setting->slug }}')</code></span>
                                        </div>
                                        <div class="col-sm-1">
                                            <button class="btn btn-danger btn-xs btn-delete" data-url="{{ route('admin.setting.destroy', $setting->id) }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                @empty
                                    <div class="row">
                                        <div class="col-xs-12">
                                            No Custom Settings. Add one?
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 text-right" style="margin-top: 25px;">
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="button" data-toggle="modal" data-target="#addModal">
                            <i class="fa fa-plus"></i>
                            Add Custom Setting
                        </button>
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit">
                            <i class="material-icons">save</i>
                            Save
                        </button>
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
                        <h4 class="modal-title">Add Custom Setting</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <label for="slug" class="control-label col-sm-2">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="slug" name="newsetting[title]" class="form-control">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="slug" class="control-label col-sm-2">Type</label>
                                    <div class="col-sm-10">
                                        <select id="slug" name="newsetting[type]" class="form-control">
                                            <option value="string">String</option>
                                            <option value="text">Textarea</option>
                                            <option value="image">Image</option>
                                        </select>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.min.js"></script>
    <script>
      $(document).ready(function () {
        $(document).on('click', '.btn-delete', function (e) {
          e.preventDefault();

          var url = $(this).data('url');
          if (url) {
            if (confirm('Are you sure?')) {
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
