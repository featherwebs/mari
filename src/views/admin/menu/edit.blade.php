@extends('featherwebs::admin.layout')

@section('title', 'Edit Menu')

@section('content')
    @component('featherwebs::admin.template.default')
        @slot('heading')
            <h2 class="mdl-card__title-text">Edit Menu {{ $menu->title }}</h2>
        @endslot
        @slot('breadcrumb')
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.menu.index') }}">Menu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        @endslot
        @component('featherwebs::admin.template.alert', ['type' => 'info'])
            How To Use:
            You can output this menu anywhere on your site by calling <code>fw_menu('{{ $menu->slug }}')->subMenus</code>
        @endcomponent
        <br>
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