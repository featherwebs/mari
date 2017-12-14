<div id="page-app" v-cloak>
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
                    <input class="form-control" name="title" type="text" v-model="page.title" id="title">
                    <span class="help-block">Page Title</span>
                </div>
            </div>
            <div class="form-group">
                <label for="sub_title" class="control-label col-sm-2">Sub Title</label>
                <div class="col-sm-10">
                    <input class="form-control" name="sub_title" type="text" v-model="page.sub_title" id="sub_title">
                    <span class="help-block">Page Subtitle</span>
                </div>
            </div>
            <div class="form-group">
                <label for="slug" class="control-label col-sm-2">Slug</label>
                <div class="col-sm-10">
                    <input class="form-control" name="slug" type="text" v-model="page.slug" id="slug" debounce="500">
                    <span class="help-block">Page Slug (appears on url)</span>
                </div>
            </div>
            <div class="form-group">
                <label for="view" class="control-label col-sm-2">View</label>
                <div class="col-sm-10">
                    <select class="form-control" name="view" v-model="page.view">
                        <option v-for="t in templates" :value="t">@{{ t }}</option>
                    </select>
                    <span class="help-block">Filename of Blade Template File</span>
                </div>
            </div>
            <div class="form-group">
                <label for="content" class="control-label col-sm-2">Content</label>
                <div class="col-sm-10">
                    <ckeditor name="content" id="content" v-model="page.content" class="editor" :config="editor.full"></ckeditor>
                    <span class="help-block">Main Content of the Page</span>
                </div>
            </div>
            <div class="form-group">
                <label for="page_id" class="control-label col-sm-2">Parent Page</label>
                <div class="col-sm-10">
                    <select class="form-control" name="page_id" v-model="page.page_id">
                        <option :value="null">None</option>
                        <option v-for="(p,k) in pages" :value="k">@{{ p }}</option>
                    </select>
                    <span class="help-block">Parent Page</span>
                </div>
            </div>
            <div class="form-group">
                <label for="is_published" class="control-label col-sm-2">Published</label>
                <div class="col-sm-10">
                    <label>
                        <input type="radio" name="is_published" id="is_published" :value="true" v-model="page.is_published">
                        Yes
                    </label>
                    <label>
                        <input type="radio" name="is_published" id="is_published" :value="false" v-model="page.is_published">
                        No
                    </label>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="image">
            <input v-for="img in deleted_image_ids" name="deleted_image_ids[]" type="hidden" :value="img">
            <div v-for="(field,i) in page.images" class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-1">
                            Image Field #@{{ i+1 }}
                        </div>
                        <div class="col-sm-11">
                            <div class="form-group">
                                <div class="col-sm-3">
                                    <div class="thumbnail">
                                        <img alt="Page Banner" :src="field.thumbnail ? field.thumbnail: 'http://via.placeholder.com/250x250'">
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <a class="pull-right btn btn-xs btn-danger" href="javascript:void(0);" class="close" @click="removeImage(i)">&times;</a>
                                    <div class="form-group">
                                        <label :for="'images['+i+'][file]'">Image Source:</label>
                                        <div class="input-group">
                                            <input v-if="field.id" :name="'images['+i+'][image_id]'" type="hidden" :value="field.id">
                                            <input :id="'images['+i+'][file]'" class="form-control" :name="'images['+i+'][file]'" type="file" @change="showPreview(i, $event)" accept="image/jpeg,image/png,image/bmp">
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
            <div v-if="!page.images.length" class="panel">
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
            <div v-for="(field,i) in page.custom" class="panel">
                <div class="panel-body">
                    <a class="pull-right btn btn-xs btn-danger" href="javascript:void(0);" class="close" @click="removeCustomField(i)">&times;</a>
                    <div class="row">
                        <div class="col-sm-1">
                            Custom Field #@{{ i+1 }}
                        </div>
                        <div class="col-sm-11">
                            <div class="row">
                                <label :for="'custom['+i+'][slug]'" class="control-label col-sm-2">Slug</label>
                                <div class="col-sm-8">
                                    <input class="form-control" :name="'custom['+i+'][slug]'" type="text" value="" id="'custom['+i+'][slug]'" v-model="field.slug">
                                    <span class="help-block">This will be used while accessing this value</span>
                                </div>
                                <div class="col-sm-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" :name="'custom['+i+'][formatted]'" v-model="field.formatted">
                                            Enable formatting
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label :for="'custom-'+i+'-value'" class="control-label col-sm-2">Value</label>
                                <div class="col-sm-10">
                                    <ckeditor :name="'custom['+i+'][value]'" :id="'custom-'+i+'-value'" v-model="field.value" class="editor mini" v-if="field.formatted" :config="editor.mini"></ckeditor>
                                    <textarea class="form-control" :name="'custom['+i+'][value]'" :id="'custom['+i+'][value]'" v-model="field.value" v-else></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="!page.custom.length" class="panel">
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
                    <input class="form-control" name="meta_title" type="text" v-model="page.meta_title" id="meta_title">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="meta_description" class="control-label col-sm-2">Meta Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="meta_description" id="meta_description" v-model="page.meta_description"></textarea>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="meta_keywords" class="control-label col-sm-2">Meta Keywords</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="meta_keywords" id="meta_keywords" v-model="page.meta_keywords"></textarea>
                    <span class="help-block">Separate keywords with a comma(,)</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
    <script>
                @if(isset($page))
        let page = JSON.parse('{!! addslashes(json_encode($page)) !!}');
                @endif
        let pages = JSON.parse('{!! addslashes(json_encode($pages)) !!}');
        let templates = JSON.parse('{!! addslashes(json_encode($templates)) !!}');
    </script>
    <script src="{{ asset('js/page.js') }}"></script>
@endpush