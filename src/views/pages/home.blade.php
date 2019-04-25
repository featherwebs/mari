@extends('layouts.app')

@section('content')
    @include('partials.slider')
    <div class="container">
        {!! $page->renderContent() !!}
    </div>
@endsection