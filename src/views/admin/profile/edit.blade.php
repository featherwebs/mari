@extends('featherwebs::admin.layout')

@section('content')
    @component('layouts.admin-template')
        @slot('heading')
            Profile Edit
        @endslot
        @slot('breadcrumb')
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        @endslot
        {{ $user->name }}
    @endcomponent
@endsection
