@extends('featherwebs::admin.layout')

@section('content')
    <form action="{{ route('admin.menu.submenu.store', $menu->slug) }}" method="POST" enctype="multipart/form-data" id="menu-app">
        {{ csrf_field() }}
        @component('layouts.admin-template')
            @slot('heading')
                Menu '{{ $menu->title }}'
                <div class="pull-right">
                    <button class="btn btn-primary btn-xs">
                        <i class="fa fa-plus"></i>
                        Save
                    </button>
                </div>
            @endslot
            @slot('breadcrumb')
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.menu.index') }}">Menu</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $menu->title }}</li>
                    </ol>
                </nav>
            @endslot
            <div class="row">
                <div class="col-sm-12">
                    Menu: <span v-html="menu.title"></span>
                </div>
                <div class="col-sm-12">
                    Slug: <span v-html="menu.slug"></span>
                </div>
                <div class="col-sm-12 text-right">
                    <a href="javascript:void(0);" @click="addSubMenu">
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
                <draggable v-model="menu.sub_menus" :options="{handle:'.handle'}">
                    <div class="panel panel-default" v-for="(sub_menu, i) in menu.sub_menus">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-1 handle">
                                            <i class="fa fa-sort"></i>
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
                                                <select class="form-control input-sm" @change="sub_menu.url = $event.target.value;">
                                                    <option value="">Custom</option>
                                                    <option v-for="page in pages" :value="page.url" v-html="page.title" :selected="sub_menu.url == page.url"></option>
                                                </select>
                                                <p class="help-block">Select a page</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Link URL</label>
                                                <input type="text" :name="'sub_menu['+i+'][url]'" v-model="sub_menu.url" class="form-control input-sm">
                                            </div>
                                        </div>
                                        <div class="col-sm-1 text-right">
                                            <a href="javascript:void(0);" class="text-danger" @click="removeSubMenu(i)">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </draggable>
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
        @endcomponent
    </form>
@endsection

@push('scripts')
    <script>
        let menu = JSON.parse('{!! addslashes(json_encode($menu)) !!}');
        let pages = JSON.parse('{!! addslashes(json_encode($pages)) !!}');
    </script>
    <script src="/js/dist/submenu.js"></script>
@endpush