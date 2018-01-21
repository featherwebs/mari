<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
    @if(auth()->check())
        @include('featherwebs::admin.partials.navbar', ['heading' => $heading])
    @endif
    <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid">
            @include('featherwebs::admin.partials.alerts')
            <div class="mdl-cell mdl-cell--12-col default-card-wide mdl-card mdl-shadow--2dp main-content">
                @isset($breadcrumb)
                    <div class="mdl-card__title demo-crumbs mdl-color-text--grey-500">
                        {{ $breadcrumb }}
                    </div>
                @endisset
                <div class="mdl-card__supporting-text">
                    {{ $slot }}
                </div>
                <div class="mdl-card__actions ">
                    {{ isset($footer) ? $footer : '' }}
                </div>
                <div class="mdl-card__menu">
                    {{ isset($tools) ? $tools : '' }}
                </div>
            </div>
        </div>
    </main>
</div>