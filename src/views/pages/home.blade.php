@extends('layouts.app')

@section('content')
    @include('partials.slider')
    <div class="container">
        {!! $page->lb_content !!}
    </div>
@endsection