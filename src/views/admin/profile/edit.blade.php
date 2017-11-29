@extends('layouts.app')

@section('content')
    @component('layouts.admin-template')
        @slot('heading')
            Profile Edit
        @endslot
        {{ $user->name }}
    @endcomponent
@endsection
