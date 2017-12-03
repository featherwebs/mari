@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.page.index') }}">Page</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>

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