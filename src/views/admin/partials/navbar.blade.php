<header class="demo-header mdl-layout__header mari-navbar">
    <div class="mdl-layout__header-row">
        <span class="mdl-layout-title">{{ $heading or 'Home' }}</span>
        <div class="mdl-layout-spacer"></div>
        <nav class="mdl-navigation">
            <a class="mdl-navigation__link" href="{{ url('/') }}" title="Visit Site" target="_blank">
                <i class="material-icons">desktop_windows</i>
            </a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="mdl-navigation__link" title="Logout">
                <i class="material-icons">exit_to_app</i>
            </a>
        </nav>
    </div>
</header>
<div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
    <header class="demo-drawer-header">
        <img src="{{ fw_thumbnail(auth()->user()) }}" class="demo-avatar">
        <div class="demo-avatar-dropdown">
            <span>{{ auth()->user()->email }}</span>
            <div class="mdl-layout-spacer"></div>
            <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                <i class="material-icons" role="presentation">arrow_drop_down</i>
                <span class="visuallyhidden">Accounts</span>
            </button>
            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
                <li class="mdl-menu__item">
                    <a href="{{ route('admin.profile.edit') }}">
                        Profile
                    </a>
                </li>
            </ul>
        </div>
    </header>
    <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
        <a class="mdl-navigation__link" href="{{ route('admin.home') }}">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Home
        </a>

        @permission('read-media')
        <a class="mdl-navigation__link" href="{{ route('admin.media.index') }}">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">perm_media</i>
            Media
        </a>
        @endpermission

        @permission('read-page')
        <a class="mdl-navigation__link" href="{{ route('admin.page.index') }}">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">insert_drive_file</i>Page
        </a>
        @endpermission

        @permission('read-post')
        @foreach(fw_post_types() as $type)
            <a class="mdl-navigation__link" href="{{ route('admin.post.index', $type->slug) }}">
                <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">widgets</i>{{ $type->title }}
            </a>
        @endforeach
        @endpermission
        @permission('read-menu')
        <a class="mdl-navigation__link" href="{{ route('admin.menu.index') }}">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">layers</i>Menu
        </a>
        @endpermission
        @foreach(config('mari.navbar', []) as $item)
            <a class="mdl-navigation__link" href="{{ route($item['route']) }}">
                <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">{{ $item['icon'] }}</i>{{ $item['label'] }}
            </a>
        @endforeach
        @permission('read-role')
        <a class="mdl-navigation__link" href="{{ route('admin.role.index') }}">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">settings_input_component</i>Roles
        </a>
        @endpermission
        @permission('read-post-type')
        <a class="mdl-navigation__link" href="{{ route('admin.post-type.index') }}">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">view_module</i>
            Post Type
        </a>
        @endpermission
        @permission('read-user')
        <a class="mdl-navigation__link" href="{{ route('admin.user.index') }}">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">perm_identity</i>
            Users
        </a>
        @endpermission
        @permission('read-setting')
        <a class="mdl-navigation__link" href="{{ route('admin.setting.index') }}">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">settings</i>
            Settings
        </a>
        @endpermission
        <div class="mdl-layout-spacer"></div>
        <a class="mdl-navigation__link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">exit_to_app</i>Logout</a>
    </nav>
</div>
