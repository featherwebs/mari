@extends('featherwebs::admin.layout')

@section('title', 'Edit '.$postType->title)

@push('styles')
    <style>
        .fw-button {
            margin-left: 5px;
        }
    </style>
@endpush

@section('content')
    @component('featherwebs::admin.template.default')
        @slot('heading')
            <h2 class="mdl-card__title-text">{{ $postType->title }}</h2>
        @endslot
        @slot('tools')
            @permission('create-post')
            <a href="{{ route('admin.post.create', $postType->slug) }}" class="mdl-button fw-button mdl-js-button mdl-button--raised mdl-button--colored">
                <i class="material-icons">add</i> Add New
            </a>
            @endpermission
            <a class="mdl-button fw-button mdl-js-button mdl-button--raised mdl-button--colored pull-right" onclick="document.getElementById('post-form').submit();">
                <i class="material-icons">save</i> Update
            </a>
        @endslot
        @slot('breadcrumb')
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.post.index', $postType->slug) }}">{{ $postType->title }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
                </ol>
            </nav>
        @endslot
        <form action="{{ route('admin.post.update', $post->slug) }}" method="POST" enctype="multipart/form-data" id="post-form">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            @include('featherwebs::admin.post.form')

            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored pull-right">
                <i class="material-icons">save</i> Update Post
            </button>

        </form>
    @endcomponent
@endsection