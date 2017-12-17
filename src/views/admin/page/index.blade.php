@extends('featherwebs::admin.layout')

@section('content')
    @component('featherwebs::admin.template.default')
        @slot('heading')
            <div class="col-md-9">
                <h2 class="mdl-card__title-text">Pages</h2>
            </div>

            <div class="col-md-3">
                <a href="{{ route('admin.page.create') }}" class="class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"">
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                        <i class="material-icons">add</i> ADD PAGES
                    </button>
                </a>
            </div>
        @endslot
        @slot('breadcrumb')
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Page</li>
                </ol>
            </nav>
        @endslot
        <div>
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        {{--<div class="col-xs-1"></div>--}}
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
                            {{--<div class="col-xs-1"></div>--}}
                            <div class="col-xs-8">
                                <a href="{{ route('admin.page.edit', $page->slug) }}">
                                {{ $page->title }}
                                <b>{{ fw_setting('homepage') == $page->id ? '--Homepage--':'' }}</b>
                                </a>
                            </div>
                            <div class="col-xs-1">
                                @if($page->is_published)
                                    <i class="material-icons text-success">check_circle</i>

                                @else
                                    <i class="material-icons">check_circle</i>
                                @endif
                            </div>
                            <div class="col-xs-3 text-right">
                                <form method="POST" action="{{ route('admin.page.destroy', $page->slug) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a href="{{ fw_setting('homepage') == $page->id ? url('/'):route('page', $page->slug) }}" target="_blank">
                                        <button class="mdl-button mdl-js-button mdl-button">
                                            <i class="material-icons">remove_red_eye</i>
                                        </button>
                                    </a>
                                    <a href="{{ route('admin.page.edit', $page->slug) }}">
                                        <button class="mdl-button mdl-js-button mdl-button">
                                            <i class="material-icons">mode_edit</i>
                                        </button>

                                    </a>
                                    @unless(fw_setting('homepage') == $page->id)
                                        <button onclick="return confirm('Are You sure?');" class="mdl-button mdl-js-button mdl-button">
                                            <i class="material-icons">delete</i>
                                        </button>
                                    @endunless
                                </form>
                            </div>
                        </div>
                    </div>
                    @if($page->subPages->count())
                        <div class="panel-body">
                            @foreach($page->subPages as $subPage)
                                <div class="row">
                                    <div class="col-xs-1 text-right">-</div>
                                    <div class="col-xs-8">
                                        {{ $subPage->title }}
                                        <b>{{ fw_setting('homepage') == $subPage->id ? '--Homepage--':'' }}</b>
                                    </div>
                                    <div class="col-xs-1">
                                        @if($subPage->is_published)
                                            <i class="fa fa-check-circle-o text-success"></i>
                                        @else
                                            <i class="fa fa-times text-muted"></i>
                                        @endif
                                    </div>
                                    <div class="col-xs-2 text-right">
                                        <form method="POST" action="{{ route('admin.page.destroy', $subPage->slug) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <a href="{{ fw_setting('homepage') == $subPage->id ? url('/'):route('page', $subPage->slug) }}" class="btn btn-xs btn-primary" target="_blank">
                                                View
                                            </a>
                                            <a href="{{ route('admin.page.edit', $subPage->slug) }}" class="btn btn-xs btn-primary">
                                                Edit
                                            </a>
                                            @unless(fw_setting('homepage') == $subPage->id)
                                                <button onclick="return confirm('Are You sure?');" class="btn btn-xs btn-danger">
                                                    Delete
                                                </button>
                                            @endunless
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        @slot('footer')
            <div class="text-right">
                {!! $pages->links() !!}
            </div>
        @endslot
    @endcomponent
@endsection