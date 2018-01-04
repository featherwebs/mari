<div class="navbar-wrapper">
    <div class="container">

        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">{{ fw_setting('title') }}</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        @if(fw_menu('main'))
                            @foreach(fw_menu('main')->subMenus as $menu)
                                <li><a href="{{ url($menu->url) }}">{{ $menu->title }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
