@extends('layouts.app')

@section('content')
    @component('layouts.admin-template')
        @slot('heading')
            Pages
        @endslot
        <form action="{{ route('admin.page.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('featherwebs::admin.page.form')
            <button class="btn btn-primary">
                <i class="fa fa-save"></i> Create
            </button>
        </form>
    @endcomponent
@endsection

@push('scripts')
@endpush