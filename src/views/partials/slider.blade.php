<!-- Carousel
    ================================================== -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        @forelse(fw_posts_by_category('slider') as $slide)
            @if($image = $slide->images()->first())
                <li data-target="#myCarousel" data-slide-to="0" class="{{ $loop->iteration == 1 ? 'active':'' }}"></li>
            @endif
        @empty
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        @endforelse
    </ol>
    <div class="carousel-inner" role="listbox">
        @forelse(fw_posts_by_category('slider') as $slide)
            @if($image = $slide->images()->first())
                <div class="item{{ $loop->iteration == 1 ? ' active':'' }}">
                    <img class="first-slide" src="{{ $image->getThumbnail(1900, 500) }}" alt="{{ $slide->title }}">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>{{ $slide->title }}</h1>
                            <p>
                                {{ $slide->sub_title }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <div class="item active">
                <img class="first-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="First slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Example headline.</h1>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus aut ea eius harum id, unde ut voluptatem. At nihil reprehenderit vel! Doloremque facere fugiat nostrum quis reiciendis velit voluptates.
                        </p>
                        <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div><!-- /.carousel -->