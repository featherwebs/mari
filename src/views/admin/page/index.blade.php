@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Page</li>

        </ol>
    </nav>

    @component('layouts.admin-template')
        @slot('heading')
            Pages
            <div class="pull-right">
                <a href="{{ route('admin.page.create') }}" class="btn btn-primary btn-xs">
                    <i class="fa fa-plus"></i>
                    Add
                </a>
            </div>
        @endslot
        <div>
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-1">ID</div>
                        <div class="col-xs-8">Title</div>
                        <div class="col-xs-1">Published</div>
                        <div class="col-xs-2">Actions</div>
                    </div>
                </div>
            </div>
            @foreach($pages as $page)
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-1">{{ $page->id }}</div>
                            <div class="col-xs-8">
                                {{ $page->title }}
                                <b>{{ fw_setting('homepage') == $page->id ? '--Homepage--':'' }}</b>
                            </div>
                            <div class="col-xs-1">
                                <a href="#" class="btn btn-xs btn-primary">
                                    @if($page->is_published)
                                        <i class="fa fa-eye"></i>
                                    @else
                                        <i class="fa fa-eye-slash"></i>
                                    @endif
                                </a>
                            </div>
                            <div class="col-xs-2 text-right">
                                <form method="POST" action="{{ route('admin.page.destroy', $page->slug) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a href="{{ fw_setting('homepage') == $page->id ? url('/'):route('page', $page->slug) }}" class="btn btn-xs btn-primary" target="_blank">
                                        View
                                    </a>
                                    <a href="{{ route('admin.page.edit', $page->slug) }}" class="btn btn-xs btn-primary">
                                        Edit
                                    </a>
                                    @unless(fw_setting('homepage') == $page->id)
                                        <button onclick="return confirm('Are You sure?');" class="btn btn-xs btn-danger">
                                            Delete
                                        </button>
                                    @endunless
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endcomponent
@endsection