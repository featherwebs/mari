@extends('featherwebs::admin.layout')

@section('title', 'Create Page')

@section('content')
    @component('featherwebs::admin.template.default')
        @slot('heading')
            <h2 class="mdl-card__title-text">Pages</h2>
        @endslot
        @slot('breadcrumb')
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.page.index') }}">Page</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        @endslot
        @slot('tools')
            <a class="mdl-button fw-button mdl-js-button mdl-button--raised mdl-button--colored pull-right" onclick="document.getElementById('page-form').submit();">
                <i class="material-icons">save</i> Save
            </a>
        @endslot
        <form action="{{ route('admin.page.store') }}" method="POST" enctype="multipart/form-data" id="page-form">
            {{ csrf_field() }}
            @include('featherwebs::admin.page.form')
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored pull-right update-button">
                <i class="material-icons">save</i> Save
            </button>
        </form>
    @endcomponent
@endsection

@push('scripts')
@endpush