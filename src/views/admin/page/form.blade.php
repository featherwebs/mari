<div id="page-app" v-cloak>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#main" role="tab" data-toggle="tab">Main Content</a></li>
        <li role="presentation" v-if="page_type_images.length">
            <a href="#image" role="tab" data-toggle="tab">Images</a></li>
        <li role="presentation" :class="{'hidden': !alias_visible('meta')}">
            <a href="#seo" role="tab" data-toggle="tab">@{{ alias('meta') }}</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="main">
            @permission('update-post-type')
            <div class="row">
                <label for="view" class="control-label col-sm-2">Page Type</label>
                <div class="col-sm-10">
                    <select class="form-control" name="page[view]" v-model="page.view">
                        <option v-for="type in page_types" :value="type.id">@{{ type.title }}</option>
                    </select>
                    <span class="help-block">Select a Page Type</span>
                </div>
            </div>
            @else
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" name="page[view]" v-model="page.view">
                    </div>
                </div>
                @endpermission
                <div class="row" :class="{'hidden': !alias_visible('title')}">
                    <label for="title" class="control-label col-sm-2">@{{ alias('title') }}</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="page[title]" type="text" v-model="page.title" id="title">
                        <span class="help-block">Page Title</span>
                    </div>
                </div>
                <div class="row" :class="{'hidden': !alias_visible('sub_title')}">
                    <label for="sub_title" class="control-label col-sm-2">@{{ alias('sub_title') }}</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="page[sub_title]" type="text" v-model="page.sub_title" id="sub_title">
                        <span class="help-block">Page Subtitle</span>
                    </div>
                </div>
                <div class="row" :class="{'hidden': !alias_visible('slug')}">
                    <label for="slug" class="control-label col-sm-2">@{{ alias('slug') }}</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="page[slug]" type="text" v-model="page.slug" id="slug" debounce="500">
                        <span class="help-block">Page Slug (appears on url)</span>
                    </div>
                </div>
                <div class="row" :class="{'hidden': !alias_visible('content')}">
                    <label for="content" class="control-label col-sm-12">@{{ alias('content') }}</label>
                </div>
                <div class="row" :class="{'hidden': !alias_visible('content')}">
                    <div class="col-sm-12">
                        <input name="page[content]" id="content" v-model="page.lb_raw_content" type="textarea" hidden>
                        <span class="help-block">Main Content of the Page</span>
                    </div>
                </div>
                <div class="row" v-for="(field,i) in page_type_non_images">
                    <label :for="'custom-'+i+'-value'" class="control-label col-sm-2">@{{ field.title }}</label>
                    <div class="col-sm-10">
                        <input :name="'page[custom]['+i+'][slug]'" type="hidden" v-model="field.slug">
                        <input :name="'page[custom]['+i+'][type]'" type="hidden" v-model="field.type">
                        <input :name="'page[custom]['+i+'][title]'" type="hidden" v-model="field.title">
                        <input :name="'page[custom]['+i+'][options]'" type="hidden" v-model="field.options">
                        <input :name="'page[custom]['+i+'][map]'" type="hidden" v-model="field.map">

                        <input class="form-control" :name="'page[custom]['+i+'][value]'" type="text" :value="getCustomValue(field.slug)" :id="'custom-'+i+'-value'" v-if="field.type=='raw-text'">
                        <input class="form-control" :name="'page[custom]['+i+'][value]'" type="number" :value="getCustomValue(field.slug)" :id="'custom-'+i+'-value'" v-if="field.type=='number'">
                        <input class="form-control" :name="'page[custom]['+i+'][value]'" type="date" :value="getCustomValue(field.slug)" :id="'custom-'+i+'-value'" v-if="field.type=='date'">
                        <input class="form-control" :name="'page[custom]['+i+'][value]'" type="time" :value="getCustomValue(field.slug)" :id="'custom-'+i+'-value'" v-if="field.type=='time'">
                        <template v-if="field.type == 'map'">
                            <map-location-selector :lnglat="getCustomValue(field.slug)" @locationupdated="locationupdated($event, field.slug, 'page[custom]['+i+'][value]')"></map-location-selector>
                            <input type="hidden" :name="'page[custom]['+i+'][value]'" :value="getCustomValue(field.slug)">
                        </template>
                        <image-selector :name="'page[custom]['+i+'][value]'" v-if="field.type=='file'" type="file" :hidevalue="false" :value="getCustomValue(field.slug)"></image-selector>
                        <select class="form-control" :name="'page[custom]['+i+'][value]'" :id="'custom-'+i+'-value'" v-if="field.type=='select'">
                            <option v-for="option in field.options.split(/\r?\n/)" :value="option" v-html="option" :selected="getCustomValue(field.slug) == option"></option>
                        </select>
                        <select class="form-control select2" :name="'page[custom]['+i+'][value][]'" :id="'custom-'+i+'-value'" v-if="field.type=='post-type'" :data-slug="field.slug">
                            <option v-for="pos in posts.filter(p => p.post_type_id == field.id)" :value="pos.id" v-html="pos.title" :selected="getCustomValue(field.slug, []).includes(pos.id)"></option>
                        </select>
                        <select class="form-control select2" :name="'page[custom]['+i+'][value][]'" :id="'custom-'+i+'-value'" v-if="field.type=='post-type-multiple'" :data-slug="field.slug" multiple>
                            <option v-for="pos in posts.filter(p => p.post_type_id == field.id)" :value="pos.id" v-html="pos.title" :selected="getCustomValue(field.slug, []).includes(pos.id)"></option>
                        </select>
                        <ckeditor :name="'page[custom]['+i+'][value]'" :id="'custom-'+i+'-value'" :value="getCustomValue(field.slug)" class="editor mini" v-if="field.type=='formatted-text'" :config="editor"></ckeditor>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="row">
                    <label for="is_published" class="control-label col-sm-2">Published</label>
                    <div class="col-sm-10">
                        <label>
                            <input type="radio" name="page[is_published]" id="is_published" :value="true" v-model="page.is_published">
                            Yes
                        </label>
                        <label>
                            <input type="radio" name="page[is_published]" id="is_published" :value="false" v-model="page.is_published">
                            No
                        </label>
                    </div>
                </div>
                <div class="row">
                    <label for="is_published" class="control-label col-sm-2">Home Page</label>
                    <div class="col-sm-10">
                        <label>
                            <input type="radio" name="homepage" value="1" {{ isset($page) && fw_setting('homepage') == $page->id ? 'checked': '' }}>
                            Yes
                        </label>
                        <label>
                            <input type="radio" name="homepage" value="0" {{ !(isset($page) && fw_setting('homepage') == $page->id) ? 'checked': '' }}>
                            No
                        </label>
                        <span class="help-block">Make this the homepage.</span>
                    </div>
                </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="image" v-if="page_type_images.length">
            <div v-for="pt in page_type_images">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>@{{ pt.title }}</b>
                        <a href="javascript:void(0)" class="btn btn-default pull-right" @click="addImageField(pt.slug)" v-if="pt.type == 'multiple-images'">+ Add Image</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-3 image-wrapper" v-for="(field,j) in page.images.filter(i => i.slug == pt.slug || i.pivot.slug == pt.slug)">
                                <div class="row text-center">
                                    <a href="javascript:void(0);" class="text-danger" @click="removeImageField(field)" v-if="pt.type == 'multiple-images'"><i class="material-icons">close</i></a>
                                    <image-selector :name="'page[images]['+pt.slug+j+'][path]'" v-model="field.url"></image-selector>
                                </div>
                                <div class="row hidden">
                                    <label :for="'images['+pt.slug+j+'][slug]'">Image Slug: </label>
                                    <input class="form-control" :name="'page[images]['+pt.slug+j+'][pivot][slug]'" type="text" v-model="field.pivot.slug">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="seo" :class="{'hidden': !alias_visible('meta')}">
            <div class="row">
                <label for="meta_title" class="control-label col-sm-2">Meta Title</label>
                <div class="col-sm-10">
                    <input class="form-control" name="page[meta_title]" type="text" v-model="page.meta_title" id="meta_title">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="row">
                <label for="meta_description" class="control-label col-sm-2">Meta Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="page[meta_description]" id="meta_description" v-model="page.meta_description"></textarea>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="row">
                <label for="meta_keywords" class="control-label col-sm-2">Meta Keywords</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="page[meta_keywords]" id="meta_keywords" v-model="page.meta_keywords"></textarea>
                    <span class="help-block">Separate keywords with a comma(,)</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
    <link rel="stylesheet" href="{{asset('vendor/laraberg/css/laraberg.css')}}">
    <style>

        .thumbnail {
            position: relative;
        }

        .thumbnail a {
            position: absolute;
            top: 0;
            right: 0;
            padding: 5px 7px;
        }

        .image-wrapper {

        }

        .image-wrapper img {
            height: 200px;
            max-width: 100%;
        }

        .tab-pane {
            padding: 20px;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.11/lodash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.11.4/ckeditor.js"></script>
    <script src="{{ asset('/vendor/laravel-filemanager/js/lfm.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ fw_setting('google-map-api') }}"></script>
    <script src="https://unpkg.com/react@16.8.6/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@16.8.6/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/moment@2.24.0/min/moment.min.js"></script>
    <script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>
    <script>
            @if($page = old('page', isset($page) ? $page : null))
      let page = JSON.parse('{!! addslashes(json_encode($page)) !!}');
            @endif
      let pages = JSON.parse('{!! addslashes(json_encode($pages)) !!}');
      let posts = JSON.parse('{!! addslashes(json_encode($posts)) !!}');
      let page_types = JSON.parse('{!! addslashes(json_encode($pageTypes)) !!}');
      let PLACEHOLDER = '{!! fw_setting('placeholder') !!}';

      Laraberg.initGutenberg('content', {laravelFilemanager: {prefix: '/mari-filemanager'}, minHeight: '800px'});
    </script>
    <script src="{{ asset('js/blocks.js') }}"></script>

    <script type="text/javascript">
        @php
            include base_path().'/vendor/featherwebs/mari/src/public/js/dist/page.js';
        @endphp
    </script>
    <script>
      $(document).ready(function () {
        $('.select2').each(function () {
          var that = this;
          var multiple = $(that).attr('multiple') !== undefined;
          $(that).select2().on('select2:select', function (e) {
            window.pageapp.addPostsRelation($(that).data('slug'), e.params.data.id, multiple);
          }).on('select2:unselect', function (e) {
            window.pageapp.removePostsRelation($(that).data('slug'), e.params.data.id);
          });
        });
      });
    </script>
@endpush