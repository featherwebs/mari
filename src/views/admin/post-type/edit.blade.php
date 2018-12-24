@extends('featherwebs::admin.layout')

@section('title', 'Edit Post Type')

@section('content')
    @component('featherwebs::admin.template.default')
        @slot('heading')
            <h2 class="mdl-card__title-text">{{ $postType->title }}</h2>
        @endslot
        @slot('tools')
            @permission('create-post-type')
            <a href="{{ route('admin.post-type.create') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                <i class="material-icons">add</i> Add New
            </a>
            @endpermission
        @endslot
        @slot('breadcrumb')
            <nav aria-label="breadcrumb" post-type="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.post-type.index') }}">Post Type</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $postType->title }}</li>
                </ol>
            </nav>
        @endslot
        <form action="{{ route('admin.post-type.update', $postType->slug) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            @include('featherwebs::admin.post-type.form')

            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored pull-right">
                <i class="material-icons">save</i> Update Post Type
            </button>

        </form>
    @endcomponent
@endsection