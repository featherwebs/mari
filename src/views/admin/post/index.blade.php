@extends('layouts.app')

@section('content')
    @component('layouts.admin-template')
        @slot('heading')
            Posts
            <div class="pull-right">
                <a href="{{ route('admin.post.create') }}" class="btn btn-primary btn-xs">
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
            @foreach($posts as $post)
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-1">{{ $post->id }}</div>
                            <div class="col-xs-8">
                                {{ $post->title }}
                            </div>
                            <div class="col-xs-1">
                                <a href="#" class="btn btn-xs btn-primary">
                                    @if($post->is_published)
                                        <i class="fa fa-eye"></i>
                                    @else
                                        <i class="fa fa-eye-slash"></i>
                                    @endif
                                </a>
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
    @endcomponent
@endsection