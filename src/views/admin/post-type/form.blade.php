<div id="post-type-app" v-cloak>
    <div class="form-group">
        <label for="title" class="control-label col-sm-2">Name</label>
        <div class="col-sm-10">
            <input class="form-control" name="title" type="text" v-model="post_type.title" id="title">
            <span class="help-block">Post Type Title</span>
        </div>
    </div>
    <h4>Column Aliases</h4>
    <div class="row" v-for="(column, i) in post_type.alias">
        <label class="control-label col-sm-2">@{{ column.title }}</label>
        <div class="col-sm-10">
            <input class="form-control" :name="'alias['+i+'][alias]'" type="text" v-model="column.alias">
            <input type="hidden" :name="'alias['+i+'][slug]'" v-model="column.slug">
            <input type="hidden" :name="'alias['+i+'][title]'" v-model="column.title">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <h4>Custom Fields</h4>
        </div>
        <div class="col-xs-6">
            <a class="pull-right" href="javascript:void(0);" @click="addCustomField">+ Add</a>
        </div>
    </div>
    <div class="form-group" v-for="(field,i) in post_type.custom">
        <div class="col-xs-2">
            <input class="form-control" :name="'custom['+i+'][slug]'" type="text" v-model="field.slug">
            <span class="help-block">Slug</span>
        </div>
        <div class="col-xs-4">
            <select class="form-control" :name="'custom['+i+'][type]'" v-model="field.type">
                <option v-for="option in custom_types" :value="option.slug" v-html="option.title"></option>
            </select>
            <span class="help-block">Data Type</span>
        </div>
        <div class="col-xs-5">
            <input class="form-control" :name="'custom['+i+'][title]'" type="text" v-model="field.title">
            <span class="help-block">Display Title</span>
        </div>
        <div class="col-xs-1">
            <button class="btn btn-xs btn-danger" type="button" @click="removeCustomField(i)">
                <i class="material-icons">remove</i>
            </button>
        </div>
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
@endpush

@push('scripts')
    <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
    <script>
        @if(isset($postType))
            let post_type = JSON.parse('{!! addslashes(json_encode($postType)) !!}');
        @endif

        {{--@if($p = old('post_type', isset($postType)?$postType:null))--}}
        {{--let post_type = JSON.parse('{!! addslashes(json_encode($p)) !!}');--}}
        {{--@endif--}}
    </script>

    <script type="text/javascript" src="https://rawgit.com/featherwebs/mari/master/src/public/js/dist/post-type.js"></script>
@endpush