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
            <div class="form-group">
                <label for="title" class="control-label col-sm-2">{{ fw_post_alias($postType, 'title', 'Post Title')  }}</label>
                <div class="col-sm-10">
                    <input class="form-control" name="post[title]" type="text" v-model="post.title" id="title">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group{{ fw_post_alias_visible($postType, 'sub_title') ? '': ' hidden' }}">
                <label for="sub_title" class="control-label col-sm-2">{{ fw_post_alias($postType, 'sub_title', 'Post Sub Title')  }}</label>
                <div class="col-sm-10">
                    <input class="form-control" name="post[sub_title]" type="text" v-model="post.sub_title" id="sub_title">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group{{ fw_post_alias_visible($postType, 'slug') ? '': ' hidden' }}">
                <label for="slug" class="control-label col-sm-2">Slug</label>
                <div class="col-sm-10">
                    <input class="form-control" name="post[slug]" type="text" v-model="post.slug" id="slug" debounce="500">
                    <span class="help-block">Appears on url</span>
                </div>
            </div>
            <div class="form-group{{ fw_post_alias_visible($postType, 'view') ? '': ' hidden' }}">
                <label for="view" class="control-label col-sm-2">{{ fw_post_alias($postType, 'view', 'Template')  }}</label>
                <div class="col-sm-10">
                    <select class="form-control" name="post[view]" v-model="post.view">
                        <option v-for="t in templates" :value="t">@{{ t }}</option>
                    </select>
                    <span class="help-block">Filename of Blade Template File</span>
                </div>
            </div>
            <div class="form-group{{ fw_post_alias_visible($postType, 'content') ? '': ' hidden' }}">
                <label for="content" class="control-label col-sm-2">{{ fw_post_alias($postType, 'content', 'Post Content')  }}</label>
                <div class="col-sm-10">
                    <ckeditor name="post[content]" id="content" v-model="post.content" class="editor" :config="editor.full"></ckeditor>
                    <span class="help-block">Main Content of the Post</span>
                </div>
            </div>

            <div class="form-group" v-for="(field,i) in post.custom">
                <label :for="'custom-'+i+'-value'" class="control-label col-sm-2">@{{ field.title }}</label>
                <div class="col-sm-10">
                    <input :name="'post[custom]['+i+'][slug]'" type="hidden" v-model="field.slug">
                    <input :name="'post[custom]['+i+'][type]'" type="hidden" v-model="field.type">
                    <input :name="'post[custom]['+i+'][title]'" type="hidden" v-model="field.title">
                    <input :name="'post[custom]['+i+'][options]'" type="hidden" v-model="field.options">
                    <input :name="'post[custom]['+i+'][map]'" type="hidden" v-model="field.map">
                    <input class="form-control" :name="'post[custom]['+i+'][value]'" type="text" v-model="field.value" :id="'custom-'+i+'-value'" v-if="field.type=='raw-text'">
                    <input class="form-control" :name="'post[custom]['+i+'][value]'" type="number" v-model="field.value" :id="'custom-'+i+'-value'" v-if="field.type=='number'">
                    <input class="form-control" :name="'post[custom]['+i+'][value]'" type="date" v-model="field.value" :id="'custom-'+i+'-value'" v-if="field.type=='date'">
                    <input class="form-control" :name="'post[custom]['+i+'][value]'" type="time" v-model="field.value" :id="'custom-'+i+'-value'" v-if="field.type=='time'">
                    <input class="form-control" :name="'post[custom]['+i+'][file]'" type="file" :id="'custom-'+i+'-value'" v-if="field.type=='file'">
                    <template v-if="field.type == 'map'">
                        <map-location-selector :longitude="Number(field.value.split(',')[1])" :latitude="Number(field.value.split(',')[0])" @locationupdated="locationupdated($event, field)"></map-location-selector>
                        <input type="hidden" :name="'post[custom]['+i+'][value]'" v-model="field.value">
                    </template>
                    {{--<image-selector :name="'post[custom]['+i+'][file]'" v-if="field.type=='file'" type="file"></image-selector>--}}
                    <select class="form-control" :name="'post[custom]['+i+'][value]'" v-model="field.value" :id="'custom-'+i+'-value'" v-if="field.type=='select'">
                        <option v-for="option in field.options.split(/\r?\n/)" :value="option" v-html="option"></option>
                    </select>
                    <select class="form-control" :name="'post[custom]['+i+'][value]'" v-model="field.value" :id="'custom-'+i+'-value'" v-if="field.type=='post-type'">
                        <option v-for="post in posts.filter(p => p.post_type_id == field.id)" :value="post.id" v-html="post.title"></option>
                    </select>
                    <ckeditor :name="'post[custom]['+i+'][value]'" :id="'custom-'+i+'-value'" v-model="field.value" class="editor mini" v-if="field.type=='formatted-text'" :config="editor.mini"></ckeditor>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group{{ fw_post_alias_visible($postType, 'tags') ? '': ' hidden' }}">
                <label for="post_type_id" class="control-label col-sm-2">Tags</label>
                <div class="col-sm-10">
                    <select class="form-control select2" name="post[tags][]" multiple>
                        <option v-for="tag in tags" :value="tag" :selected="post.tags.filter(t => t.title == tag).length">@{{ tag }}</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group{{ fw_post_alias_visible($postType, 'is_published') ? '': ' hidden' }}">
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
            <div class="form-group{{ fw_post_alias_visible($postType, 'is_featured') ? '': ' hidden' }}">
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
                        <div class="row" v-for="(chunk,j) in _.chunk(post.images.filter(i => i.slug == pt.slug || i.pivot.slug == pt.slug), 4)">
                            <div class="col-sm-3" v-for="(field,i) in chunk">
                                <div class="form-group text-center">
                                    <a href="javascript:void(0);" class="text-danger" @click="removeImageField(field)" v-if="pt.type == 'multiple-images'"><i class="material-icons">close</i></a>
                                    <image-selector :name="'post[images]['+pt.slug+j+i+'][path]'" :value="field.url"></image-selector>
                                </div>
                                <div class="form-group hidden">
                                    <label :for="'images['+pt.slug+j+i+'][slug]'">Image Slug: </label>
                                    <input class="form-control" :name="'post[images]['+pt.slug+j+i+'][pivot][slug]'" type="text" v-model="field.pivot.slug">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="seo">
            <div class="form-group">
                <label for="meta_title" class="control-label col-sm-2">Meta Title</label>
                <div class="col-sm-10">
                    <input class="form-control" name="post[meta_title]" type="text" v-model="post.meta_title" id="meta_title">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="meta_description" class="control-label col-sm-2">Meta Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="post[meta_description]" id="meta_description" v-model="post.meta_description"></textarea>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
    <style>
        .thumbnail {
            position:relative;
        }
        .thumbnail a {
            position: absolute;
            top: 0;
            right: 0;
            padding: 5px 7px;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.11/lodash.min.js"></script>
    <script src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/vendor/laravel-filemanager/js/lfm.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ fw_setting('google-map-api') }}"></script>
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
        @if(isset($tags))
            let tags = JSON.parse('{!! addslashes(json_encode($tags)) !!}');
        @endif
        let post_types = JSON.parse('{!! addslashes(json_encode($postTypes)) !!}');
        let templates = JSON.parse('{!! addslashes(json_encode($templates)) !!}');
        $(document).ready(function () {
            $('.select2').select2({
                tags: true,
                placeholder: "Add your tags"
            });
        });
    </script>

    <script type="text/javascript">
        @php
            include base_path().'/vendor/featherwebs/mari/src/public/js/dist/post.js';
        @endphp
    </script>
@endpush