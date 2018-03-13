@extends('layouts.app')

@section('content')
    <section class="margin-bottom-fix">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="row">
                        <div class="col-sm-12">
                            <h1>{!! $post->title !!}</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            {!! $post->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection