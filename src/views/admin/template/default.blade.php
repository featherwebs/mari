<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer">
    <div class="mdl-layout__drawer">

        <nav class="mdl-navigation">
            @if(auth()->check())
                @include('featherwebs::admin.partials.navbar')
            @endif
        </nav>
    </div>
    <main class="mdl-layout__content">
        <div class="page-content"><!-- Your content goes here --></div>
    </main>
</div>
<nav class="navbar navbar-default mari-navbar navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed hidden-xs" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Mari | {!! fw_setting('title') !!}</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse hidden-xs" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/" target="_blank"><i class="fa fa-desktop" aria-hidden="true"></i> View Site</a></li>
                <li><a href="#"><i class="fa fa-life-ring" aria-hidden="true"></i> Support</a></li>
                @permission('manage-setting')
                <li><a href="{{ route('admin.setting.index') }}"><i class="fa fa-cogs" aria-hidden="true"></i> Settings</a></li>
                @endpermission
                <li class="dropdown">
                    <a href="{{ route('admin.profile.edit') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user-circle fa-2x"></i>
                        {{ auth()->user()->name }}
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('admin.profile.edit') }}">Profile</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> <i class="fa fa-sign-out fa-2x"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="container-fluid admin--container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            @isset($breadcrumb)
                <div class="col-md-12">
                    {{ $breadcrumb }}
                </div>
            @endisset
            <div class="col-md-12">
                @include('partials.alerts')
                <div class="default-card-wide mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title">
                        {{ $heading }}
                    </div>
                    <div class="mdl-card__supporting-text">
                        {{ $slot }}
                    </div>
                    <div class="mdl-card__actions ">
                        {{ isset($footer) ? $footer : '' }}
                    </div>
                </div>
                {{--<div class="panel-footer">--}}
                {{--{{ isset($footer) ? $footer : '' }}--}}
                {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
</div>