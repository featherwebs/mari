@extends('featherwebs::admin.layout')

@section('content')
    @component('featherwebs::admin.template.default')
        @slot('heading')
            <h2 class="mdl-card__title-text"><span class="page-title-first">Page/ </span>  {{ $page->title }}</h2>
            <a href="{{ route('admin.page.create') }}" class="class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"">
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored pull-right">
                <i class="material-icons">add</i> Add New
            </button>
            </a>
        @endslot
        @slot('breadcrumb')
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.page.index') }}">Page</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        @endslot
        <form action="{{ route('admin.page.update', $page->slug) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            @include('featherwebs::admin.page.form')

            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored pull-right update-button">
                <i class="material-icons">autorenew</i> Update
            </button>
        </form>
    @endcomponent
@endsection