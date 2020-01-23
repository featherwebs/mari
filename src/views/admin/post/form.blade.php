<div id="post-app" v-cloak>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#main" role="tab" data-toggle="tab">Main Content</a></li>
        <li role="presentation" v-if="post_type_images.length">
            <a href="#image" role="tab" data-toggle="tab">Images</a></li>
        @if(fw_post_alias_visible($postType, 'meta'))
            <li role="presentation">
                <a href="#seo" role="tab" data-toggle="tab">Seo</a></li>
        @endif
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <input type="hidden" :value="post_type.id" name="post[post_type_id]">
        <div role="tabpanel" class="tab-pane active" id="main">
            <div class="row">
                <label for="title" class="control-label col-sm-2">{{ fw_post_alias($postType, 'title', 'Post Title')  }}</label>
                <div class="col-sm-10">
                    <input class="form-control" name="post[title]" type="text" v-model="post.title" id="title">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="row{{ fw_post_alias_visible($postType, 'sub_title') ? '': ' hidden' }}">
                <label for="sub_title" class="control-label col-sm-2">{{ fw_post_alias($postType, 'sub_title', 'Post Sub Title')  }}</label>
                <div class="col-sm-10">
                    <input class="form-control" name="post[sub_title]" type="text" v-model="post.sub_title" id="sub_title">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="row{{ fw_post_alias_visible($postType, 'slug') ? '': ' hidden' }}">
                <label for="slug" class="control-label col-sm-2">Slug</label>
                <div class="col-sm-10">
                    <input class="form-control" name="post[slug]" type="text" v-model="post.slug" id="slug" debounce="500">
                    <span class="help-block">Appears on url</span>
                </div>
            </div>
            <div class="row{{ fw_post_alias_visible($postType, 'view') ? '': ' hidden' }}">
                <label for="view" class="control-label col-sm-2">{{ fw_post_alias($postType, 'view', 'Template')  }}</label>
                <div class="col-sm-10">
                    <select class="form-control" name="post[view]" v-model="post.view">
                        <option v-for="t in templates" :value="t">@{{ t }}</option>
                    </select>
                    <span class="help-block">Filename of Blade Template File</span>
                </div>
            </div>
            <div class="row{{ fw_post_alias_visible($postType, 'content') ? '': ' hidden' }}">
                <label for="content" class="control-label col-sm-12">{{ fw_post_alias($postType, 'content', 'Post Content')  }}</label>
            </div>
            <div class="row{{ fw_post_alias_visible($postType, 'content') ? '': ' hidden' }}">
                <div class="col-sm-12">
                    <input name="post[content]" id="content" v-model="post.lb_raw_content" class="editor">
                    <span class="help-block">Main Content of the Post</span>
                </div>
            </div>

            <div class="row" v-for="(field,i) in post.custom">
                <label :for="'custom-'+i+'-value'" class="control-label col-sm-2">@{{ field.title }}</label>
                <div class="col-sm-10">
                    <input :name="'post[custom]['+i+'][slug]'" type="hidden" v-model="field.slug">
                    <input :name="'post[custom]['+i+'][type]'" type="hidden" :value="field.type">
                    <input :name="'post[custom]['+i+'][title]'" type="hidden" v-model="field.title">
                    <input :name="'post[custom]['+i+'][options]'" type="hidden" v-model="field.options">
                    <input :name="'post[custom]['+i+'][map]'" type="hidden" v-model="field.map">
                    <input type="hidden" :name="'post[custom]['+i+'][value]'" v-model="field.value"/>

                    <input class="form-control" :name="'post[custom]['+i+'][value]'" type="text" v-model="field.value" :id="'custom-'+i+'-value'" v-if="field.type=='raw-text'">
                    <input class="form-control" :name="'post[custom]['+i+'][value]'" type="number" v-model="field.value" :id="'custom-'+i+'-value'" v-if="field.type=='number'">
                    <input class="form-control" :name="'post[custom]['+i+'][value]'" type="date" v-model="field.value" :id="'custom-'+i+'-value'" v-if="field.type=='date'">
                    <input class="form-control" :name="'post[custom]['+i+'][value]'" type="time" v-model="field.value" :id="'custom-'+i+'-value'" v-if="field.type=='time'">
                    <template v-if="field.type == 'map'">
                        <map-location-selector :lnglat="field.value" @locationupdated="locationupdated($event, field.slug, 'post[custom]['+i+'][value]')"></map-location-selector>
                        <input type="hidden" :name="'post[custom]['+i+'][value]'" v-model="field.value">
                    </template>
                    <image-selector :name="'post[custom]['+i+'][value]'" v-if="field.type=='file'" type="file" :hidevalue="false" v-model="field.value"></image-selector>
                    <select class="form-control" :name="'post[custom]['+i+'][value]'" :id="'custom-'+i+'-value'" v-if="field.type=='select'" v-model="field.value">
                        <option v-for="option in field.options.split(/\r?\n/)" :value="option" v-html="option" :selected="field.value == option"></option>
                    </select>

                    <select class="form-control" :name="'post[custom]['+i+'][value][]'" :id="'custom-'+i+'-value'" v-if="field.type=='post-type'" :data-slug="field.slug" v-model="field.value">
                        <option v-for="pos in posts.filter(p => p.post_type_id == field.id)" :value="pos.id" v-html="pos.title"></option>
                    </select>
                    <select class="form-control" :name="'post[custom]['+i+'][value][]'" :id="'custom-'+i+'-value'" v-if="field.type=='post-type-multiple'" :data-slug="field.slug" multiple v-model="field.value">
                        <option v-for="pos in posts.filter(p => p.post_type_id == field.id)" :value="pos.id" v-html="pos.title"></option>
                    </select>
                    {{--                    <ckeditor :name="'post[custom]['+i+'][value]'" :id="'custom-'+i+'-value'" v-model="field.value" class="editor mini" v-if="field.type=='formatted-text'" :config="editor"></ckeditor>--}}
                    <vue-editor :id="'custom-'+i+'-value'"  type="text" class="" :editor-toolbar="customToolbar" v-if="field.type=='formatted-text'" v-model="field.value">
                    </vue-editor>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="row{{ fw_post_alias_visible($postType, 'is_published') ? '': ' hidden' }}">
                <label for="is_published" class="control-label col-sm-2">{{ fw_post_alias($postType, 'is_published', 'Published')  }}</label>
                <div class="col-sm-10">
                    <label>
                        <input type="radio" name="post[is_published]" id="is_published" :value="true" v-model="post.is_published">
                        Yes
                    </label>
                    <label>
                        <input type="radio" name="post[is_published]" id="is_published" :value="false" v-model="post.is_published">
                        No
                    </label>
                </div>
            </div>
            <div class="row{{ fw_post_alias_visible($postType, 'is_featured') ? '': ' hidden' }}">
                <label for="is_featured" class="control-label col-sm-2">{{ fw_post_alias($postType, 'is_featured', 'Featured')  }}</label>
                <div class="col-sm-10">
                    <label>
                        <input type="radio" name="post[is_featured]" id="is_featured" :value="true" v-model="post.is_featured">
                        Yes
                    </label>
                    <label>
                        <input type="radio" name="post[is_featured]" id="is_featured" :value="false" v-model="post.is_featured">
                        No
                    </label>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="image" v-if="post_type_images.length">
            <div v-for="pt in post_type_images">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>@{{ pt.title }}</b>
                        <a href="javascript:void(0)" class="btn btn-default pull-right" @click="addImageField(pt.slug)" v-if="pt.type == 'multiple-images'">+ Add Image</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-3 image-wrapper" v-for="(field,j) in post.images.filter(i => i.slug == pt.slug || i.pivot.slug == pt.slug)">
                                <div class="row text-center">
                                    <a href="javascript:void(0);" class="text-danger" @click="removeImageField(field)" v-if="pt.type == 'multiple-images'"><i class="material-icons">close</i></a>
                                    <image-selector :name="'post[images]['+pt.slug+j+'][path]'" v-model="field.url"></image-selector>
                                </div>
                                <div class="row hidden">
                                    <label :for="'images['+pt.slug+j+'][slug]'">Image Slug: </label>
                                    <input class="form-control" :name="'post[images]['+pt.slug+j+'][pivot][slug]'" type="text" v-model="field.pivot.slug">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="seo">
            <div class="row">
                <label for="meta_title" class="control-label col-sm-2">Meta Title</label>
                <div class="col-sm-10">
                    <input class="form-control" name="post[meta_title]" type="text" v-model="post.meta_title" id="meta_title">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="row">
                <label for="meta_description" class="control-label col-sm-2">Meta Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="post[meta_description]" id="meta_description" v-model="post.meta_description"></textarea>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="row">
                <label for="meta_keywords" class="control-label col-sm-2">Meta Keywords</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="post[meta_keywords]" id="meta_keywords" v-model="post.meta_keywords"></textarea>
                    <span class="help-block">Separate keywords with a comma(,)</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
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
    <script src="{{ asset('/vendor/laravel-filemanager/js/lfm.js') }}"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ fw_setting('google-map-api') }}"></script>
    <script src="https://unpkg.com/react@16.8.6/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@16.8.6/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/moment@2.24.0/min/moment.min.js"></script>
    <script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>
    <script>
            @if($p = old('post', isset($post) ? $post : null))
      let post = JSON.parse('{!! addslashes(json_encode($p)) !!}');
            @endif
            @if(!empty($postType))
      let post_type = JSON.parse('{!! addslashes(json_encode($postType)) !!}');
            @endif
            @if(!empty($posts))
      let posts = JSON.parse('{!! addslashes(json_encode($posts)) !!}');
            @endif
      let post_types = JSON.parse('{!! addslashes(json_encode($postTypes)) !!}');
      let templates = JSON.parse('{!! addslashes(json_encode($templates)) !!}');
      Laraberg.init('content', {laravelFilemanager: {prefix: '/mari-filemanager'}, minHeight: '800px'});
    </script>
    <script src="{{ asset('vendor/coblocks/dist/blocks.build.js') }}"></script>

    <script type="text/javascript">
        @php
            include base_path().'/vendor/featherwebs/mari/src/public/js/dist/post.js';
        @endphp
    </script>
    <script>
      $(document).ready(function () {
        $('.select2').each(function () {
          var that = this;
          var multiple = $(that).attr('multiple') !== undefined;
          $(that).select2().on('select2:select', function (e) {
            window.postapp.addPostsRelation($(that).data('slug'), e.params.data.id, multiple);
          }).on('select2:unselect', function (e) {
            window.postapp.removePostsRelation($(that).data('slug'), e.params.data.id);
          });
        });
      });
    </script>
@endpush