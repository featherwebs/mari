@if (session('status'))
    @component('featherwebs::admin.template.alert', ['type' => 'default'])
        {{ session('status') }}
    @endcomponent
@endif
@if (session('success'))
    @component('featherwebs::admin.template.alert', ['type' => 'success'])
        {{ session('success') }}
    @endcomponent
@endif
@if (session('warning'))
    @component('featherwebs::admin.template.alert', ['type' => 'warning'])
        {{ session('warning') }}
    @endcomponent
@endif
@if ($errors->all())
    @component('featherwebs::admin.template.alert', ['type' => 'warning'])
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endcomponent
@endif