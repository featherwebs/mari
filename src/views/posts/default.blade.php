@extends('layouts.app')

@section('content')
    <section class="academics-wrapper margin-bottom-fix">
        <div class="container-fluid">
            <div class="row">
                <div id="myCarousel" class="carousel media carousel-fade" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        @forelse(fw_image('slider') as $media)
                            <div class="item{{ $loop->first ? ' active': '' }}">
                                <img class="img-responsive" src="{{ $media->getThumbnail(1905, 708) }}" alt="{{ $media->getCustom('title') }}">
                                <h2>{{ $media->getCustom('title') }}</h2>
                                <h3>{{ $media->getCustom('caption') }}</h3>
                            </div>
                        @empty
                            <div class="item active">
                                <img class="img-responsive" src="http://via.placeholder.com/1905x708?text=[banner]" alt="">
                            </div>
                        @endforelse
                    </div>
                    <div class="banner_overlay"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="academics-descriptions margin-bottom-fix">
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