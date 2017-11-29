@extends('layouts.app')

@section('content')
    @component('layouts.admin-template')
        @slot('heading')
            User
        @endslot
        <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('featherwebs::admin.user.form')
            <button class="btn btn-primary">
                <i class="fa fa-save"></i> Create
            </button>
        </form>
    @endcomponent
@endsection

@push('scripts')
@endpush