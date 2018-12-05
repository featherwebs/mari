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
        <div class="row">
            <div class="col-sm-12 text-right">
                <a href="javascript:void(0);" @click="addSubMenu(false)">
                    + Add
                </a>
            </div>
        </div>
        <div>
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-1">#</div>
                        <div class="col-xs-8">Title</div>
                        <div class="col-xs-1">Published</div>
                        <div class="col-xs-2">Actions</div>
                    </div>
                </div>
            </div>
            <div>
                <div v-for="(sub_menu, i) in _.sortBy(menu.sub_menus, 'order')">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-1 handle">
                                            <button class="btn btn-xs" type="button" v-if="i>0" @click="swap(menu.sub_menus, i, i-1)">
                                                <span class="glyphicon glyphicon-triangle-top"></span>
                                            </button>
                                            <button class="btn btn-xs" type="button" v-if="i<(menu.sub_menus.length-1)" @click="swap(menu.sub_menus, i, i+1)">
                                                <span class="glyphicon glyphicon-triangle-bottom"></span>
                                            </button>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" :name="'sub_menu['+i+'][title]'" v-model="sub_menu.title" class="form-control input-sm">
                                                <p class="help-block">Recommended 30 Characters</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select class="form-control input-sm" v-model="sub_menu.type">
                                                    <option v-for="(t, i) in types" :value="i" v-html="t"></option>
                                                </select>
                                                <p class="help-block">Select a Type</p>
                                            </div>
                                        </div>
                                        <div :class="sub_menu.type == 'custom' ? '': 'col-sm-2'">
                                            <div class="form-group" v-if="sub_menu.type == 'page'">
                                                <label>Page</label>
                                                <select class="form-control input-sm" @change="sub_menu.url = $event.target.value;">
                                                    <option>Select a Page</option>
                                                    <option v-for="page in pages" :value="page.url" v-html="page.title" :selected="sub_menu.url == page.url"></option>
                                                </select>
                                                <p class="help-block">Select a page</p>
                                            </div>
                                            <div class="form-group" v-if="sub_menu.type == 'post'">
                                                <label>Post</label>
                                                <select class="form-control input-sm" @change="sub_menu.url = $event.target.value;">
                                                    <option>Select a Post</option>
                                                    <option v-for="post in posts" :value="post.url" v-html="post.title" :selected="sub_menu.url == post.url"></option>
                                                </select>
                                                <p class="help-block">Select a post</p>
                                            </div>
                                        </div>
                                        <div :class="sub_menu.type == 'custom' ? 'col-sm-5': 'col-sm-3'">
                                            <div class="form-group">
                                                <label>Link URL</label>
                                                <input type="text" :name="'sub_menu['+i+'][url]'" v-model="sub_menu.url" class="form-control input-sm">
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <a href="javascript:void(0);" class="text-danger btn btn-xs" @click="removeSubMenu(i)">
                                                <i class="fa fa-times"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="btn btn-xs mt" @click="addSubMenu(sub_menu)">
                                                + Add Submenu
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-for="(sm, j) in _.sortBy(sub_menu.sub_menus, 'order')">
                        <div class="panel sub-panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-1 handle">
                                                <button class="btn btn-xs" type="button" v-if="j>0" @click="swap(sub_menu.sub_menus, j, j-1)">
                                                    <span class="glyphicon glyphicon-triangle-top"></span>
                                                </button>
                                                <button class="btn btn-xs" type="button" v-if="j<(sub_menu.sub_menus.length-1)" @click="swap(sub_menu.sub_menus, j, j+1)">
                                                    <span class="glyphicon glyphicon-triangle-bottom"></span>
                                                </button>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" :name="'sub_menu['+i+'][sub_menus]['+j+'][title]'" v-model="sm.title" class="form-control input-sm">
                                                    <p class="help-block">Recommended 30 Characters</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label>Type</label>
                                                    <select class="form-control input-sm" v-model="sm.type">
                                                        <option v-for="(t, i) in types" :value="i" v-html="t"></option>
                                                    </select>
                                                    <p class="help-block">Select a Type</p>
                                                </div>
                                            </div>
                                            <div :class="sm.type == 'custom' ? '': 'col-sm-2'">
                                                <div class="form-group" v-if="sm.type == 'page'">
                                                    <label>Page</label>
                                                    <select class="form-control input-sm" @change="sm.url = $event.target.value;">
                                                        <option>Select a Page</option>
                                                        <option v-for="page in pages" :value="page.url" v-html="page.title" :selected="sm.url == page.url"></option>
                                                    </select>
                                                    <p class="help-block">Select a page</p>
                                                </div>
                                                <div class="form-group" v-if="sm.type == 'post'">
                                                    <label>Post</label>
                                                    <select class="form-control input-sm" @change="sm.url = $event.target.value;">
                                                        <option>Select a Post</option>
                                                        <option v-for="post in posts" :value="post.url" v-html="post.title" :selected="sm.url == post.url"></option>
                                                    </select>
                                                    <p class="help-block">Select a post</p>
                                                </div>
                                            </div>
                                            <div :class="sm.type == 'custom' ? 'col-sm-5': 'col-sm-3'">
                                                <div class="form-group">
                                                    <label>Link URL</label>
                                                    <input type="text" :name="'sub_menu['+i+'][sub_menus]['+j+'][url]'" v-model="sm.url" class="form-control input-sm">
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <a href="javascript:void(0);" class="text-danger btn btn-xs" @click="removeSubMenu(j, sub_menu)">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-xs mt" @click="addSubMenu(sm)">
                                                    + Add Submenu
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-for="(ssm, k) in _.sortBy(sm.sub_menus, 'order')">
                            <div class="panel sub-sub-panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-1 handle">
                                                    <button class="btn btn-xs" type="button" v-if="k>0" @click="swap(sm.sub_menus, k, k-1)">
                                                        <span class="glyphicon glyphicon-triangle-top"></span>
                                                    </button>
                                                    <button class="btn btn-xs" type="button" v-if="k<(sm.sub_menus.length-1)" @click="swap(sm.sub_menus, k, k+1)">
                                                        <span class="glyphicon glyphicon-triangle-bottom"></span>
                                                    </button>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Title</label>
                                                        <input type="text" :name="'sub_menu['+i+'][sub_menus]['+j+'][sub_menus]['+k+'][title]'" v-model="ssm.title" class="form-control input-sm">
                                                        <p class="help-block">Recommended 30 Characters</p>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label>Type</label>
                                                        <select class="form-control input-sm" v-model="ssm.type">
                                                            <option v-for="(t, i) in types" :value="i" v-html="t"></option>
                                                        </select>
                                                        <p class="help-block">Select a Type</p>
                                                    </div>
                                                </div>
                                                <div :class="ssm.type == 'custom' ? '': 'col-sm-2'">
                                                    <div class="form-group" v-if="ssm.type == 'page'">
                                                        <label>Page</label>
                                                        <select class="form-control input-sm" @change="ssm.url = $event.target.value;">
                                                            <option>Select a Page</option>
                                                            <option v-for="page in pages" :value="page.url" v-html="page.title" :selected="ssm.url == page.url"></option>
                                                        </select>
                                                        <p class="help-block">Select a page</p>
                                                    </div>
                                                    <div class="form-group" v-if="ssm.type == 'post'">
                                                        <label>Post</label>
                                                        <select class="form-control input-sm" @change="ssm.url = $event.target.value;">
                                                            <option>Select a Post</option>
                                                            <option v-for="post in posts" :value="post.url" v-html="post.title" :selected="ssm.url == post.url"></option>
                                                        </select>
                                                        <p class="help-block">Select a post</p>
                                                    </div>
                                                </div>
                                                <div :class="ssm.type == 'custom' ? 'col-sm-5': 'col-sm-3'">
                                                    <div class="form-group">
                                                        <label>Link URL</label>
                                                        <input type="text" :name="'sub_menu['+i+'][sub_menus]['+j+'][sub_menus]['+k+'][url]'" v-model="ssm.url" class="form-control input-sm">
                                                    </div>
                                                </div>
                                                <div class="col-sm-1">
                                                    <a href="javascript:void(0);" class="text-danger btn btn-xs" @click="removeSubMenu(k, sm)">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="!(menu.sub_menus.length)">
            <div class="alert alert-callout alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p class="text-capitalize">no submenu available</p>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .sub-panel {
            margin-left: 40px;
        }

        .sub-sub-panel {
            margin-left: 80px;
        }

        .mt {
            margin-top: 4em;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.11/lodash.min.js"></script>
    <script>
                @if(isset($menu))
        let menu = JSON.parse('{!! addslashes(json_encode($menu)) !!}');
                @endif
        let pages = JSON.parse('{!! addslashes(json_encode($pages)) !!}');
        let postTypes = JSON.parse('{!! addslashes(json_encode($postTypes)) !!}');
        let posts = JSON.parse('{!! addslashes(json_encode($posts)) !!}');
    </script>

    <script type="text/javascript">
        @php
            include base_path().'/vendor/featherwebs/mari/src/public/js/dist/menu.js';
        @endphp
    </script>
@endpush