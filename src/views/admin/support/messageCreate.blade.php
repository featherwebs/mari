@extends('featherwebs::admin.layout')

@section('title', 'Create Message')

@section('content')
    @component('featherwebs::admin.template.default')
        @slot('heading')
            <h2 class="mdl-card__title-text">Message</h2>
        @endslot
        @slot('breadcrumb')
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.support.index') }}">Support</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.support.show', $slug) }}">TICKET#{{ $slug }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        @endslot
        <form action="{{ env('SUPPORT_API_URL') }}support/ticket/{{ $slug }}/message/store" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input name="api_token" value="{{ env('SUPPORT_TOKEN') }}" type="hidden">
            @include('featherwebs::admin.support.messageForm')
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored pull-right">
                <i class="material-icons">save</i> Save
            </button>
        </form>
    @endcomponent
@endsection

@push('scripts')
@endpush