@extends('featherwebs::admin.layout')

@section('title', 'Edit User')

@section('content')
    @component('featherwebs::admin.template.default')
        @slot('heading')
            @if(isset($profile))
                <h2 class="mdl-card__title-text">Profile</h2>
            @else
                <h2 class="mdl-card__title-text">User</h2>
            @endif
        @endslot
        @slot('breadcrumb')
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                    @if(isset($profile))
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    @else
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="{{ route('admin.user.index') }}">User</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    @endif
                </ol>
            </nav>
        @endslot
        <form action="{{ route('admin.user.update', $user->username) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            @include('featherwebs::admin.user.form')
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored pull-right">
                <i class="material-icons">save</i> Update
            </button>
        </form>
    @endcomponent
@endsection