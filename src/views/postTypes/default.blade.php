@extends('layouts.app')

@section('content')
    <div class="dummy-nav dummy"></div>

    <div class="container">
        <h1>{!! $title !!}</h1>
        <div class="row event-details">
            @foreach($posts as $post)
                <div class="col-sm-3">
                    <div class="row">
                        <div class="col-sm-12 col-xs-5">
                            <figure>
                                <img class="img-responsive" src="{{ fw_thumbnail($post, 265, 220) }}" alt="{{ $post->title }}">
                            </figure>
                        </div>
                        <div class="col-sm-12 col-xs-7">
                            <a href="#" class="remove-hyper">
                                <figcaption>
                                    {!! $post->title !!}
                                </figcaption>
                                <p class="event-detail-date">
                                    {!! $post->created_at->format('j, M Y') !!}
                                </p>
                                <p class="event-detail-content">
                                    {!! $post->sub_title !!}
                                </p>
                            </a>
                            <a class="btn event-btn hidden-xs" href="#">View details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row col-sm-12">
            {!! $posts->links() !!}
        </div>
    </div>
@endsection