@if (session('status'))
    <div class="alert mdl-cell mdl-cell--12-col mdl-components__default">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('status') }}
    </div>
@endif
@if (session('success'))
    <div class="alert mdl-cell mdl-cell--12-col mdl-components__success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('success') }}
    </div>
@endif
@if (session('warning'))
    <div class="alert mdl-cell mdl-cell--12-col mdl-components__warning">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('warning') }}
    </div>
@endif
@if ($errors->all())
    <div class="alert mdl-cell mdl-cell--12-col mdl-components__warning">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif