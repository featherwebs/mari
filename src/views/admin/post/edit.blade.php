@extends('featherwebs::admin.layout')

@section('content')
    @component('featherwebs::admin.template.default')
        @slot('heading')
            Posts
        @endslot
        @slot('breadcrumb')
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.post.index') }}">Post</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
                </ol>
            </nav>
        @endslot
        <form action="{{ route('admin.post.update', $post->slug) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            @include('featherwebs::admin.post.form')

            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored pull-right">
                <i class="material-icons">add</i> Update Post
            </button>

        </form>
    @endcomponent
@endsection