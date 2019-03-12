@extends('featherwebs::admin.layout')

@section('title', 'Create '.$postType->title)

@section('content')
    @component('featherwebs::admin.template.default')
        @slot('heading')
            <h2 class="mdl-card__title-text">{{ $postType->title }}</h2>
        @endslot
        @slot('breadcrumb')
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="{{ route('admin.post.index', $postType) }}">{{ $postType->title }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        @endslot
        @slot('tools')
            <a class="mdl-button fw-button mdl-js-button mdl-button--raised mdl-button--colored pull-right" onclick="document.getElementById('post-form').submit();">
                <i class="material-icons">save</i> Save
            </a>
        @endslot
        <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data" id="post-form">
            {{ csrf_field() }}
            @include('featherwebs::admin.post.form')
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored pull-right">
                <i class="material-icons">save</i> Save
            </button>
        </form>
    @endcomponent
@endsection

@push('scripts')
@endpush