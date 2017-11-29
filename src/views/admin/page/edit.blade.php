@extends('layouts.app')

@section('content')
    @component('layouts.admin-template')
        @slot('heading')
            Pages
        @endslot
        <form action="{{ route('admin.page.update', $page->slug) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            @include('featherwebs::admin.page.form')
            <button class="btn btn-primary">
                <i class="fa fa-save"></i> Update
            </button>
        </form>
    @endcomponent
@endsection