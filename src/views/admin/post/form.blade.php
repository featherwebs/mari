<div id="post-app" v-cloak>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#main" role="tab" data-toggle="tab">Main Content</a></li>
        <li role="presentation" v-if="post.images.length">
            <a href="#image" role="tab" data-toggle="tab">Images</a></li>
        <li role="presentation">
            <a href="#seo" role="tab" data-toggle="tab">Seo</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <input type="hidden" :value="post_type.id" name="post_type_id">
        <div role="tabpanel" class="tab-pane active" id="main">
            <div class="form-group">
                <label for="title" class="control-label col-sm-2">{{ fw_post_alias($postType, 'title', 'Post Title')  }}</label>
                <div class="col-sm-10">
                    <input class="form-control" name="title" type="text" v-model="post.title" id="title">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="sub_title" class="control-label col-sm-2">{{ fw_post_alias($postType, 'sub_title', 'Post Sub Title')  }}</label>
                <div class="col-sm-10">
                    <input class="form-control" name="sub_title" type="text" v-model="post.sub_title" id="sub_title">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="slug" class="control-label col-sm-2">Slug</label>
                <div class="col-sm-10">
                    <input class="form-control" name="slug" type="text" v-model="post.slug" id="slug" debounce="500">
                    <span class="help-block">Appears on url</span>
                </div>
            </div>
            <div class="form-group">
                <label for="view" class="control-label col-sm-2">{{ fw_post_alias($postType, 'view', 'Template')  }}</label>
                <div class="col-sm-10">
                    <select class="form-control" name="view" v-model="post.view">
                        <option v-for="t in templates" :value="t">@{{ t }}</option>
                    </select>
                    <span class="help-block">Filename of Blade Template File</span>
                </div>
            </div>
            <div class="form-group">
                <label for="content" class="control-label col-sm-2">{{ fw_post_alias($postType, 'content', 'Post Content')  }}</label>
                <div class="col-sm-10">
                    <ckeditor name="content" id="content" v-model="post.content" class="editor" :config="editor.full"></ckeditor>
                    <span class="help-block">Main Content of the Post</span>
                </div>
            </div>
            <div class="form-group" v-for="(field,i) in post.custom">
                <label :for="'custom-'+i+'-value'" class="control-label col-sm-2">@{{ field.title }}</label>
                <div class="col-sm-10">
                    <input :name="'custom['+i+'][slug]'" type="hidden" v-model="field.slug">
                    <input :name="'custom['+i+'][type]'" type="hidden" v-model="field.type">
                    <input :name="'custom['+i+'][title]'" type="hidden" v-model="field.title">
                    <input class="form-control" :name="'custom['+i+'][value]'" type="text" v-model="field.value" :id="'custom-'+i+'-value'" v-if="field.type=='raw-text'">
                    <input class="form-control" :name="'custom['+i+'][value]'" type="number" v-model="field.value" :id="'custom-'+i+'-value'" v-if="field.type=='number'">
                    <input class="form-control" :name="'custom['+i+'][value]'" type="date" v-model="field.value" :id="'custom-'+i+'-value'" v-if="field.type=='date'">
                    <ckeditor :name="'custom['+i+'][value]'" :id="'custom-'+i+'-value'" v-model="field.value" class="editor mini" v-if="field.type=='formatted-text'" :config="editor.mini"></ckeditor>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="post_type_id" class="control-label col-sm-2">Tags</label>
                <div class="col-sm-10">
                    <select class="form-control select2" name="tags[]" multiple>
                        <option v-for="tag in tags" :value="tag" :selected="post.tags.filter(t => t.title == tag).length">@{{ tag }}</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="is_published" class="control-label col-sm-2">{{ fw_post_alias($postType, 'is_published', 'Published')  }}</label>
                <div class="col-sm-10">
                    <label>
                        <input type="radio" name="is_published" id="is_published" :value="true" v-model="post.is_published">
                        Yes
                    </label>
                    <label>
                        <input type="radio" name="is_published" id="is_published" :value="false" v-model="post.is_published">
                        No
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="is_featured" class="control-label col-sm-2">{{ fw_post_alias($postType, 'is_featured', 'Featured')  }}</label>
                <div class="col-sm-10">
                    <label>
                        <input type="radio" name="is_featured" id="is_featured" :value="true" v-model="post.is_featured">
                        Yes
                    </label>
                    <label>
                        <input type="radio" name="is_featured" id="is_featured" :value="false" v-model="post.is_featured">
                        No
                    </label>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="image" v-if="post.images.length">
            <input v-for="img in deleted_image_ids" name="deleted_image_ids[]" type="hidden" :value="img">
            <div v-for="(field,i) in post.images" class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="col-sm-3">
                                    <div class="thumbnail">
                                        <img :alt="field.title" :src="field.thumbnail ? field.thumbnail: 'http://via.placeholder.com/250x250'">
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <label :for="'images['+i+'][file]'">Image Source:</label>
                                        <div class="input-group">
                                            <input v-if="field.id" :name="'images['+i+'][image_id]'" type="hidden" :value="field.id">
                                            <input :id="'images['+i+'][file]'" class="form-control" :name="'images['+i+'][file]'" type="file" @change="showPreview(i, $event)" accept="image/jpeg,image/png,image/bmp">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label :for="'images['+i+'][slug]'">Image Slug: </label>
                                        <input class="form-control" :name="'images['+i+'][meta]'" type="text" v-model="field.slug">
                                    </div>
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
                    <input class="form-control" name="meta_title" type="text" v-model="post.meta_title" id="meta_title">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="meta_description" class="control-label col-sm-2">Meta Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="meta_description" id="meta_description" v-model="post.meta_description"></textarea>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="meta_keywords" class="control-label col-sm-2">Meta Keywords</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="meta_keywords" id="meta_keywords" v-model="post.meta_keywords"></textarea>
                    <span class="help-block">Separate keywords with a comma(,)</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
@endpush

@push('scripts')
    <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script>
                @if(isset($post))
        let post = JSON.parse('{!! addslashes(json_encode($post)) !!}');
                @endif
                @if(!empty($postType))
        let post_type = JSON.parse('{!! addslashes(json_encode($postType)) !!}');
                @endif
                {{--@if($p = old('post', isset($post)?$post:null))--}}
                {{--let post = JSON.parse('{!! addslashes(json_encode($p)) !!}');--}}
                {{--@endif--}}
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

    <script type="text/javascript" src="https://rawgit.com/featherwebs/mari/master/src/public/js/dist/post.js"></script>



@endpush