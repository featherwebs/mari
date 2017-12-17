@extends('featherwebs::admin.layout')

@section('content')
    @component('featherwebs::admin.template.default')
        @slot('heading')
            Pages
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
        <form action="{{ route('admin.page.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('featherwebs::admin.page.form')
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored pull-right update-button">
                <i class="material-icons">create</i> Publish
            </button>
        </form>
    @endcomponent
@endsection

@push('scripts')
@endpush