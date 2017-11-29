<!--HOME BANNER SLIDER  -->
<section class="home-banner-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div id="myCarousel" class="carousel media carousel-fade mini" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img class="img-responsive" src="/images/cover.jpg" alt="home media">
                    </div>
                </div>
                <div class="banner_overlay"></div>
            </div>
        </div>
    </div>
</section>
<!--HOME BANNER SLIDER ENDS  -->

<div class="container margin-top-2">
    <div class="row">
        @if(auth()->check())
            <div class="col-md-12 padding-2">
                @include('partials.admin-navbar')
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('partials.alerts')
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $heading }}
                </div>

                <div class="panel-body">
                    {{ $slot }}
                </div>

                <div class="panel-footer">
                    {{ isset($footer) ? $footer : '' }}
                </div>
            </div>
        </div>
    </div>
</div>