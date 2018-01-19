<div class="row" id="menu-app" v-cloak>
    <div class="col-sm-12">
        <div class="form-group">
            <label for="title" class="control-label col-sm-2">Title</label>
            <div class="col-sm-10">
                <input class="form-control" name="menu[title]" type="text" v-model="menu.title" id="title" required>
                <span class="help-block">Name of the Menu</span>
            </div>
        </div>
        <div class="form-group">
            <label for="slug" class="control-label col-sm-2">Slug</label>
            <div class="col-sm-10">
                <input class="form-control" name="menu[slug]" type="text" v-model="menu.slug" id="slug" readonly>
                <span class="help-block">Slug of the Menu</span>
            </div>
        </div>
        <hr>
        <div class="row" v-for="(custom,i) in menu.custom">
            <div class="col-sm-12 well">
                <a href="javascript:void(0);" class="close pull-right text-danger" @click="removeCustomField(i)">&times;</a>
                <div class="form-group">
                    <label class="control-label col-sm-2">Slug</label>
                    <div class="col-sm-10">
                        <input class="form-control" :name="'menu[custom]['+i+'][slug]'" type="text" v-model="custom.slug">
                        <span class="help-block">Cutom Field Slug</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Value</label>
                    <div class="col-sm-10">
                        <input class="form-control" :name="'menu[custom]['+i+'][value]'" type="text" v-model="custom.value">
                        <span class="help-block">Custom Field Value</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group text-right">
            <a href="javascript:void(0);" @click="addCustomField">+ Add Custom Field</a>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        @if(isset($menu))
            let menu = JSON.parse('{!! addslashes(json_encode($menu)) !!}');
        @endif
    </script>

    <script type="text/javascript">
        @php
            include base_path().'/vendor/featherwebs/mari/src/public/js/dist/menu.js';
        @endphp
    </script>
@endpush