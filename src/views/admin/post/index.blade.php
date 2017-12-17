@extends('featherwebs::admin.layout')

@section('content')
    @component('featherwebs::admin.template.default')
        @slot('heading')
            <div class="col-md-9">
                <h2>Posts</h2>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin.post.create') }}">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                    <i class="material-icons">add</i> Add Posts
                </button>
                </a>

            </div>
        @endslot
        @slot('breadcrumb')
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Post</li>
                </ol>
            </nav>
        @endslot
        <div>
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-1">ID</div>
                        <div class="col-xs-6">Title</div>
                        <div class="col-xs-1">Type</div>
                        <div class="col-xs-1">Tags</div>
                        <div class="col-xs-1">Published</div>
                        <div class="col-xs-2">Actions</div>
                    </div>
                </div>
            </div>
            @foreach($posts as $post)
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-1">{{ $post->id }}</div>
                            <div class="col-xs-6">
                                {{ $post->title }}
                            </div>
                            <div class="col-xs-1">
                                {{ $post->postType->title }}
                            </div>
                            <div class="col-xs-1">
                                {{ $post->tags->count() ? $post->tags->implode('title',', '): '-' }}
                            </div>
                            <div class="col-xs-1">
                                @if($post->is_published)
                                    <i class="fa fa-check-circle-o text-success"></i>
                                @else
                                    <i class="fa fa-times text-muted"></i>
                                @endif
                            </div>
                            <div class="col-xs-2 text-right">
                                <form method="POST" action="{{ route('admin.post.destroy', $post->slug) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a href="{{ route('admin.post.edit', $post->slug) }}" class="btn btn-xs btn-primary">
                                        View
                                    </a>
                                    <a href="{{ route('admin.post.edit', $post->slug) }}" class="btn btn-xs btn-primary">
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
            @endforeach
        </div>
        @slot('footer')
            <div class="text-right">
                {!! $posts->links() !!}
            </div>
        @endslot
    @endcomponent
@endsection