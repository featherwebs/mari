@extends('featherwebs::admin.layout')

@section('title', 'Edit Page')

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
            <h2 class="mdl-card__title-text"><span class="page-title-first">Page/ </span>  {{ $page->title }}</h2>
        @endslot
        @slot('tools')
            @permission('create-page')
            <a href="{{ route('admin.page.create') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                <i class="material-icons">add</i> Add New
            </a>
            @endpermission
            <a class="mdl-button fw-button mdl-js-button mdl-button--raised mdl-button--colored pull-right" onclick="document.getElementById('page-form').submit();">
                <i class="material-icons">save</i> Update
            </a>
        @endslot
        @slot('breadcrumb')
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.page.index') }}">Page</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
                </ol>
            </nav>
        @endslot
        <form action="{{ route('admin.page.update', $page->slug) }}" method="POST" enctype="multipart/form-data" id="page-form">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            @include('featherwebs::admin.page.form')

            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored pull-right update-button">
                <i class="material-icons">save</i> Update
            </button>
        </form>
    @endcomponent
@endsection