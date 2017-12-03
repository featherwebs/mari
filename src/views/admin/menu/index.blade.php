@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Menu</li>
        </ol>
    </nav>

    <div id="menu-app">
        @component('layouts.admin-template')
            @slot('heading')
                Menu
                <div class="pull-right">
                    <a href="{{ route('admin.menu.create') }}" class="btn btn-primary btn-xs">
                        <i class="fa fa-plus"></i>
                        Add
                    </a>
                </div>
            @endslot
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-1">#</div>
                        <div class="col-xs-4">Title</div>
                        <div class="col-xs-2">Sub Menus</div>
                        <div class="col-xs-2">Slug</div>
                        <div class="col-xs-3 text-right">Action</div>
                    </div>
                </div>
            </div>
            @forelse($menus as $menu)
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-1">{{ $menu->id }}</div>
                            <div class="col-xs-4">
                                {{ $menu->title }}
                            </div>
                            <div class="col-xs-2">
                                {{ $menu->subMenus->count() }}
                            </div>
                            <div class="col-xs-2">
                                {{ $menu->slug }}
                            </div>
                            <div class="col-xs-3 text-right">
                                <form method="POST" action="{{ route('admin.menu.destroy', $menu->slug) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a href="{{ route('admin.menu.show', $menu->slug) }}" class="btn btn-xs btn-primary">
                                        Submenus
                                    </a>
                                    <a href="{{ route('admin.menu.edit', $menu->slug) }}" class="btn btn-xs btn-primary">
                                        Edit
                                    </a>
                                    <button onclick="return confirm('Are You sure?');" class="btn btn-xs btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-callout alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p class="text-capitalize">no menu available</p>
                </div>
            @endforelse
        @endcomponent
    </div>
@endsection