@extends('featherwebs::admin.layout')

@section('title', 'Create User')

@section('content')
    @component('featherwebs::admin.template.default')
        @slot('heading')
            <h2 class="mdl-card__title-text">Users</h2>
        @endslot
        @slot('breadcrumb')
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.user.index') }}">User</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        @endslot
        <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('featherwebs::admin.user.form')
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored pull-right">
                <i class="material-icons">save</i> Save
            </button>
        </form>
    @endcomponent
@endsection

@push('scripts')
@endpush