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
<div class="row">
    <div class="col-xs-12">
        <ul class="nav nav-pills admin-nav">
            <li role="presentation">
                <a href="{{ route('admin.home') }}">
                    <i class="fa fa-dashboard fa-2x"></i>
                    Dashboard
                </a>
            </li>
            @permission('manage-media')
            <li role="presentation">
                <a href="{{ route('admin.media.index') }}">
                    <i class="fa fa-image fa-2x"></i>
                    Media
                </a>
            </li>
            @endpermission
            @permission('manage-page')
            <li role="presentation">
                <a href="{{ route('admin.page.index') }}">
                    <i class="fa fa-file-text-o fa-2x"></i>
                    Page
                </a>
            </li>
            @endpermission
            @permission('manage-post')
            <li role="presentation">
                <a href="{{ route('admin.post.index') }}">
                    <i class="fa fa-newspaper-o fa-2x"></i>
                    Post
                </a>
            </li>
            @endpermission
            @permission('manage-menu')
            <li role="presentation">
                <a href="{{ route('admin.menu.index') }}">
                    <i class="fa fa-list fa-2x"></i>
                    Menu
                </a>
            </li>
            @endpermission
            @permission('manage-user')
            <li role="presentation">
                <a href="{{ route('admin.user.index') }}">
                    <i class="fa fa-users fa-2x"></i>
                    Users
                </a>
            </li>
            @endpermission
            @permission('manage-setting')
            <li role="presentation">
                <a href="{{ route('admin.setting.index') }}">
                    <i class="fa fa-cogs fa-2x"></i>
                    Setting
                </a>
            </li>
            @endpermission
            <li role="presentation" class="pull-right">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out fa-2x"></i>
                    Logout
                </a>
            </li>
            <li role="presentation" class="pull-right">
                <a href="{{ route('admin.profile.edit') }}">
                    <i class="fa fa-user-circle fa-2x"></i>
                    {{ auth()->user()->name }}
                </a>
            </li>
        </ul>
    </div>
</div>
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