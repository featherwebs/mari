@extends('layouts.app')

@section('content')
    @component('layouts.admin-template')
        @slot('heading')
            Posts
        @endslot
        <form action="{{ route('admin.post.update', $post->slug) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            @include('featherwebs::admin.post.form')
            <button class="btn btn-primary">
                <i class="fa fa-save"></i> Update
            </button>
        </form>
    @endcomponent
@endsection