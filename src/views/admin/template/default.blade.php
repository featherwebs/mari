<div class="container margin-top-2">
    <div class="row">
        @if(auth()->check())
            <div class="col-md-12 padding-2">
                @include('partials.admin-navbar')
            </div>
        @endif
    </div>
    <div class="row">
        @isset($breadcrumb)
            <div class="col-md-12">
                {{ $breadcrumb }}
            </div>
        @endisset
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