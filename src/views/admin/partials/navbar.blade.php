@push('styles')
    <style>
        .admin-nav a {
            text-align: center;
            width: 100px;
        }

        .admin-nav a i {
            display: block;
        }
    </style>
@endpush
<ul class="nav mar-nav">
            <li role="presentation">
                <a class="mdl-navigation__link" href="{{ route('admin.home') }}">
                    <i class="fa fa-dashboard fa-2x"></i> Dashboard
                </a>
            </li>
            @permission('manage-media')
            <li role="presentation">
                <a class="mdl-navigation__link" href="{{ route('admin.media.index') }}">
                    <i class="fa fa-image fa-2x"></i>
                    Media
                </a>
            </li>
            @endpermission
            @permission('manage-page')
            <li role="presentation">
                <a class="mdl-navigation__link" href="{{ route('admin.page.index') }}">
                    <i class="fa fa-file-text-o fa-2x"></i>
                    Page
                </a>
            </li>
            @endpermission
            @permission('manage-post')
            <li role="presentation">
                <a class="mdl-navigation__link" href="{{ route('admin.post.index') }}">
                    <i class="fa fa-newspaper-o fa-2x"></i>
                    Post
                </a>
            </li>
            @endpermission
            @permission('manage-menu')
            <li role="presentation">
                <a class="mdl-navigation__link" href="{{ route('admin.menu.index') }}">
                    <i class="fa fa-list fa-2x"></i>
                    Menu
                </a>
            </li>
            @endpermission
            @foreach(config('mari.navbar', []) as $item)
                <li role="presentation">
                    <a class="mdl-navigation__link" href="{{ route($item['route']) }}">
                        <i class="{{ $item['icon'] }} fa-2x"></i>
                        {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
            @permission('manage-user')
            <li role="presentation" class="hidden-md hidden-lg">
                <a class="mdl-navigation__link" href="{{ route('admin.user.index') }}">
                    <i class="fa fa-users fa-2x"></i>
                    Users
                </a>
            </li>
            @endpermission
            <li role="presentation" class="hidden-md hidden-lg">
                <a class="mdl-navigation__link" href="{{ route('admin.profile.edit') }}">
                    Profile
                </a>
            </li>
            @permission('manage-setting')
            <li role="presentation" class="hidden-md hidden-lg">
                <a class="mdl-navigation__link" href="{{ route('admin.setting.index') }}">
                    Settings
                </a>
            </li>
            @endpermission

            <li role="presentation" class="hidden-md hidden-lg">
                <a class="mdl-navigation__link"  href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out fa-2x"></i> Logout
                </a>
            </li>
            {{--@permission('manage-setting')--}}
            {{--<li role="presentation">--}}
                {{--<a href="{{ route('admin.setting.index') }}">--}}
                    {{--<i class="fa fa-cogs fa-2x"></i>--}}
                    {{--Setting--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--@endpermission--}}
            {{--<li role="presentation" class="pull-right">--}}
                {{--<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">--}}
                    {{--<i class="fa fa-sign-out fa-2x"></i>--}}
                    {{--Logout--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li role="presentation" class="pull-right">--}}
                {{--<a href="{{ route('admin.profile.edit') }}">--}}
                    {{--<i class="fa fa-user-circle fa-2x"></i>--}}
                    {{--{{ auth()->user()->name }}--}}
                {{--</a>--}}
            {{--</li>--}}
   <li class="featherwebs-mari-footer">
       © Copyright {{ date('Y') }}. Baked with Mari &trade;. All Rights Reserved.<br>
       Handcrafted by <a href="http://featherwebs.com" class="color-yellow" target="_blank">Featherwebs</a>
   </li>
        </ul>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
@push('scripts')
    <script>
        $(document).ready(function () {
            $('.admin-nav').find('a[href="{{ url()->current() }}"]').closest('li[role=presentation]').addClass('active');
        });
    </script>
@endpush