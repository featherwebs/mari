@extends('layouts.app')

@section('content')
    @component('layouts.admin-template')
        @slot('heading')
            User
        @endslot
        <form action="{{ route('admin.user.update', $user->username) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            @include('featherwebs::admin.user.form')
            <button class="btn btn-primary">
                <i class="fa fa-save"></i> Update
            </button>
        </form>
    @endcomponent
@endsection