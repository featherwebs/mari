@extends('layouts.app')

@section('content')
    @component('layouts.admin-template')
        @slot('heading')
            Edit Menu {{ $menu->title }}
        @endslot
        <form action="{{ route('admin.menu.update', $menu->slug) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            @include('featherwebs::admin.menu.form')
            <button class="btn btn-primary">
                <i class="fa fa-save"></i> Update
            </button>
        </form>
    @endcomponent
@endsection

@push('scripts')
@endpush