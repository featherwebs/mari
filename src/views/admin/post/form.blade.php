<div id="post-app">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#main" role="tab" data-toggle="tab">Main Content</a></li>
        <li role="presentation">
            <a href="#image" role="tab" data-toggle="tab">Images</a></li>
        <li role="presentation">
            <a href="#custom" role="tab" data-toggle="tab">Custom Fields</a></li>
        <li role="presentation">
            <a href="#seo" role="tab" data-toggle="tab">Seo</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="main">
            <div class="form-group">
                <label for="title" class="control-label col-sm-2">Title</label>
                <div class="col-sm-10">
                    <input class="form-control" name="title" type="text" v-model="post.title" id="title">
                    <span class="help-block">Post Title</span>
                </div>
            </div>
            <div class="form-group">
                <label for="sub_title" class="control-label col-sm-2">Sub Title</label>
                <div class="col-sm-10">
                    <input class="form-control" name="sub_title" type="text" v-model="post.sub_title" id="sub_title">
                    <span class="help-block">Post Subtitle</span>
                </div>
            </div>
            <div class="form-group">
                <label for="slug" class="control-label col-sm-2">Slug</label>
                <div class="col-sm-10">
                    <input class="form-control" name="slug" type="text" v-model="post.slug" id="slug" debounce="500">
                    <span class="help-block">Post Slug (appears on url)</span>
                </div>
            </div>
            <div class="form-group">
                <label for="view" class="control-label col-sm-2">View</label>
                <div class="col-sm-10">
                    <select class="form-control" name="view" v-model="post.view">
                        <option v-for="t in templates" :value="t">@{{ t }}</option>
                    </select>
                    <span class="help-block">Filename of Blade Template File</span>
                </div>
            </div>
            <div class="form-group">
                <label for="content" class="control-label col-sm-2">Content</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="content" id="content" v-model="post.content"></textarea>
                    <span class="help-block">Main Content of the Post</span>
                </div>
            </div>
            <div class="form-group">
                <label for="post_type_id" class="control-label col-sm-2">Post Type</label>
                <div class="col-sm-10">
                    <select class="form-control" name="post_type_id" v-model="post.post_type_id" id="post_type_id">
                        {{--<option :value="null">None</option>--}}
                        <option v-for="(p,k) in post_types" :value="k">@{{ p }}</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group" v-if="post.post_type_id==1"> <!-- 1 for post type event-->
                <label for="event_on" class="control-label col-sm-2">Event Date</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="event_on" multiple id="event_on" v-model="post.event_on">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="post_type_id" class="control-label col-sm-2">Tags</label>
                <div class="col-sm-10">
                    <select class="form-control select2" name="tags[]" multiple>
                        <option v-for="(p,k) in tags" :value="k" :selected="post.tags.filter(tag => tag.id == k).length">@{{ p }}</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="is_published" class="control-label col-sm-2">Published</label>
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
                <label for="is_featured" class="control-label col-sm-2">Featured</label>
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
        <div role="tabpanel" class="tab-pane" id="image">
            <input v-for="img in deleted_image_ids" name="deleted_image_ids[]" type="hidden" :value="img">
            <div v-for="(field,i) in post.images" class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-1">
                            Image Field #@{{ i+1 }}
                        </div>
                        <div class="col-sm-11">
                            <div class="form-group">
                                <div class="col-sm-3">
                                    <div class="thumbnail">
                                        <img alt="Post Banner" :src="field.thumbnail ? field.thumbnail: 'http://via.placeholder.com/250x250'">
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <a class="pull-right btn btn-xs btn-danger" href="javascript:void(0);" class="close" @click="removeImage(i)">&times;</a>
                                    <div class="form-group">
                                        <label :for="'images['+i+'][file]'">Image Source:</label>
                                        <div class="input-group">
                                            <input v-if="field.id" :name="'images['+i+'][image_id]'" type="hidden" :value="field.id">
                                            <input :id="'images['+i+'][file]'" class="form-control" :name="'images['+i+'][file]'" type="file" @change="showPreview(i, $event)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label :for="'images['+i+'][slug]'">Image Slug: </label>
                                        <input class="form-control" :name="'images['+i+'][meta]'" type="text" v-model="field.meta">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="!post.images.length" class="panel">
                <div class="panel-body">
                    No Images. Add one?
                </div>
            </div>
            <button type="button" class="btn btn-primary btn-sm pull-right" @click="addImageField">
                <i class="fa fa-plus"></i>
                Add New Image
            </button>
        </div>
        <div role="tabpanel" class="tab-pane" id="custom">
            <div v-for="(field,i) in post.custom" class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-1">
                            Custom Field #@{{ i+1 }}
                        </div>
                        <div class="col-sm-11">
                            <a class="pull-right btn btn-xs btn-danger" href="javascript:void(0);" class="close" @click="removeCustomField(i)">&times;</a>
                            <div class="form-group">
                                <label :for="'custom['+i+'][slug]'" class="control-label col-sm-2">Slug</label>
                                <div class="col-sm-10">
                                    <input class="form-control" :name="'custom['+i+'][slug]'" type="text" value="" id="'custom['+i+'][slug]'" v-model="field.slug">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label :for="'custom['+i+'][value]'" class="control-label col-sm-2">Value</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" :name="'custom['+i+'][value]'" :id="'custom['+i+'][value]'" v-model="field.value"></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="!post.custom.length" class="panel">
                <div class="panel-body">
                    No Custom Field. Add one?
                </div>
            </div>
            <button type="button" class="btn btn-primary btn-sm pull-right" @click="addCustomField">
                <i class="fa fa-plus"></i>
                Add New Custom Field
            </button>
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
    <script src="{{ asset('js/post.js') }}"></script>
@endpush