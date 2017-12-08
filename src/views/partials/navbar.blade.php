<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid nav_inner_wrapper-main_nav_align">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <br class="clear" />
            <a class="navbar-brand hidden-md-down" href="{{ route('home') }}"><img class="img-responsive" src="/images/kist_logo.svg" alt="kist logo"></a>
            <a class="navbar-brand hidden-md-up" href="{{ route('home') }}"><img class="img-responsive" src="/images/mobile_logo.svg" alt="kist logo"></a>

            <br class="clear" />
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <br class="clear" />
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right nav-topnav">
                @if(fw_menu('main'))
                    @foreach(fw_menu('main')->subMenus as $menu)
                        <li><a href="{{ url($menu->url) }}">{{ $menu->title }}</a></li>
                    @endforeach
                @endif
            </ul>

        </div><!-- /.navbar-collapse -->
        <a class="navbar-apply" href="enroll.php">Apply Now <span class="apply_arrow">&#8600;</span></a>
    </div><!-- /.container-fluid -->
</nav>
