<div id="post-type-app" v-cloak>
    <div class="form-group">
        <label for="title" class="control-label col-sm-2">Name</label>
        <div class="col-sm-10">
            <input class="form-control" name="title" type="text" v-model="post_type.title" id="title" required pattern=".{3,}" title="3 characters minimum">
            <span class="help-block">Post Type Title</span>
        </div>
    </div>
    <h4>Column Aliases</h4>
    <div class="row">
        <div class="col-sm-2"><h6>Column</h6></div>
        <div class="col-sm-2"><h6>Visibility</h6></div>
        <div class="col-sm-4"><h6>Alias</h6></div>
        <div class="col-sm-2"><h6>Default</h6></div>
        <div class="col-sm-2"><h6>Code Reference</h6></div>
    </div>
    <div class="row" v-for="(column, i) in post_type.alias">
        <label class="control-label col-sm-2">@{{ column.title }}</label>
        <div class="col-sm-2">
            <select :name="'alias['+i+'][visible]'" class="form-control" v-model="column.visible" :readonly="column.required===true || column.required==='true'">
                <option :value="true">Shown</option>
                <option :value="false" v-if="!(column.required===true || column.required==='true')">Hidden</option>
            </select>
        </div>
        <div class="col-sm-4">
            <input class="form-control" :name="'alias['+i+'][alias]'" type="text" v-model="column.alias">
            <input type="hidden" :name="'alias['+i+'][slug]'" v-model="column.slug">
            <input type="hidden" :name="'alias['+i+'][title]'" v-model="column.title">
            <input type="hidden" :name="'alias['+i+'][required]'" v-model="column.required">
            <span class="help-block"></span>
        </div>
        <div class="col-sm-2">
            <input class="form-control" :name="'alias['+i+'][default]'" type="text" v-model="column.default">
        </div>
        <div class="col-sm-2">
            <code>$post->@{{ column.slug }}</code>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <h4>Custom Fields</h4>
        </div>
        <div class="col-xs-6">
            <a class="pull-right btn btn-default" href="javascript:void(0);" @click="addCustomField">+ Add</a>
        </div>
    </div>
    <div class="row" v-for="(field,i) in post_type.custom">
        <div class="form-group">
            <div class="col-xs-2">
                <input :name="'custom['+i+'][pivot][slug]'" type="hidden" v-model="field.slug">
                <input class="form-control" :name="'custom['+i+'][slug]'" type="text" v-model="field.slug">
                <span class="help-block">Slug</span>
            </div>
            <div class="col-xs-2">
                <div class="row">
                    <div class="col-xs-12">
                        <select class="form-control" :name="'custom['+i+'][type]'" v-model="field.type">
                            <option v-for="option in custom_types" :value="option.slug" v-html="option.title"></option>
                        </select>
                        <span class="help-block">Data Type</span>
                    </div>
                    <div class="col-xs-12" v-if="field.type=='select'">
                        <textarea class="form-control" :name="'custom['+i+'][options]'" v-model="field.options" rows="3"></textarea>
                        <span class="help-block">Options</span>
                    </div>
                    <div class="col-xs-12" v-if="field.type=='post-type'">
                        <select class="form-control" :name="'custom['+i+'][id]'" v-model="field.id">
                            <option v-for="post in post_types" :value="post.id" v-html="post.title"></option>
                        </select>
                        <span class="help-block">Options</span>
                    </div>
                </div>
            </div>
            <div class="col-xs-4">
                <input class="form-control" :name="'custom['+i+'][title]'" type="text" v-model="field.title">
                <span class="help-block">Display Title</span>
            </div>
            <div class="col-xs-2">
                <input class="form-control" :name="'custom['+i+'][default]'" type="text" v-model="field.default">
                <span class="help-block">Default</span>
            </div>
            <div class="col-xs-2">
                <code>$post->getCustom('@{{ field.slug }}')</code>
                <button class="btn btn-xs btn-danger pull-right" type="button" @click="removeCustomField(i)">
                    X
                </button>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.min.js"></script>
    <script>
                @if(isset($postType))
        let post_type = JSON.parse('{!! addslashes(json_encode($postType)) !!}');
                @endif

                @if(isset($postTypes))
        let post_types = JSON.parse('{!! addslashes(json_encode($postTypes)) !!}');
        @endif

        {{--@if($p = old('post_type', isset($postType)?$postType:null))--}}
        {{--let post_type = JSON.parse('{!! addslashes(json_encode($p)) !!}');--}}
        {{--@endif--}}
    </script>

    <script type="text/javascript">
        @php
            include base_path().'/vendor/featherwebs/mari/src/public/js/dist/post-type.js';
        @endphp
    </script>
@endpush