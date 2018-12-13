<header class="demo-header mdl-layout__header mari-navbar">
    <div class="mdl-layout__header-row">
        <span class="mdl-layout-title">{{ $heading or 'Home' }}</span>
        <div class="mdl-layout-spacer"></div>
        <nav class="mdl-navigation">
            <a class="mdl-navigation__link" href="{{ route('admin.support.index') }}" title="Support">
                <i class="material-icons">headset_mic</i>
            </a>
            <a class="mdl-navigation__link" href="{{ url('/') }}" title="Visit Site" target="_blank">
                <i class="material-icons">desktop_windows</i>
            </a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="mdl-navigation__link" title="Logout">
                <i class="material-icons">power_settings_new</i>
            </a>
        </nav>
    </div>
</header>
<div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50" data-scrollbar>
    <a href="{{ route('admin.profile.edit') }}" class="mdl-color-text--blue-grey-50" title="Goto Profile">
        <header class="demo-drawer-header">
            <img src="{{ fw_thumbnail(auth()->user(), 64, 64) }}" class="demo-avatar">
            <div class="demo-avatar-dropdown">
                <span>{{ auth()->user()->email }}</span>
                <div class="mdl-layout-spacer"></div>
                <button class="mdl-button mdl-js-button mdl-button--icon">
                    <i class="material-icons" role="presentation">arrow_forward</i>
                </button>
            </div>
        </header>
    </a>
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
            @if(array_key_exists('permission', $item) && !empty($item['permission']))
                @permission($item['permission'])
                <a class="mdl-navigation__link" href="{{ route($item['route']) }}">
                    <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">{{ $item['icon'] }}</i>{{ $item['label'] }}
                </a>
                @endpermission
            @else
                <a class="mdl-navigation__link" href="{{ route($item['route']) }}">
                    <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">{{ $item['icon'] }}</i>{{ $item['label'] }}
                </a>
            @endif
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
        <a class="mdl-navigation__link" href="{{ route('admin.support.index') }}">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">headset_mic</i>
            Support
        </a>
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
