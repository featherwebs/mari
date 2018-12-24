@extends('featherwebs::admin.layout')

@section('title', 'Ticket')

@push('styles')
    <style>
        .note-wrapper {
            padding: 15px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .file-url {
            text-align: center;
            display: inline-block;
            padding: 5px;
        }

        .file-url span {
            display: block;
        }
    </style>
@endpush

@section('content')
    @component('featherwebs::admin.template.default')
        @slot('heading')
            <h2 class="mdl-card__title-text">TICKET#{{ strtoupper($ticket->slug) }}</h2>
        @endslot
        {{--@slot('tools')--}}
        {{--<a href="{{ route('admin.support.create') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">--}}
        {{--<i class="material-icons">add</i>--}}
        {{--Add--}}
        {{--</a>--}}
        {{--@endslot--}}
        @slot('breadcrumb')
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="{{ route('admin.support.index') }}">Support</a></li>
                    <li class="breadcrumb-item active" aria-current="page">TICKET#{{ strtoupper($ticket->slug) }}</li>
                </ol>
            </nav>
        @endslot
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Summary</h3>
                </div>
                <div class="col-sm-12">
                    <h4>Ticket Information</h4>
                    <div class="row">
                        <div class="col-sm-2"><strong>Owner</strong></div>
                        <div class="col-sm-10">
                            {{ $ticket->token->tokenable->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"><strong>Title</strong></div>
                        <div class="col-sm-10">
                            {{ $ticket->title }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"><strong>Message</strong></div>
                        <div class="col-sm-10">
                            {!! $ticket->message !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"><strong>Type</strong></div>
                        <div class="col-sm-10">
                            {{ $ticket->type ? $ticket->type->title : '-' }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"><strong>Status</strong></div>
                        <div class="col-sm-10">
                            {{ $ticket->status }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"><strong>Attachment(s)</strong></div>
                        <div class="col-sm-10">
                            <div class="row">
                                @forelse($ticket->images as $image)
                                    <div class="col-sm-3">
                                        <a href="{{ $image->url }}" target="_blank">
                                            <img src="{{ $image->thumbnail }}" class="img-responsive">
                                        </a>
                                    </div>
                                @empty
                                    <div class="col-sm-12">
                                        No Attachments Available!
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    {{--<div class="row">--}}
                    {{--<div class="col-sm-3">Assigned User(s)</div>--}}
                    {{--<div class="col-sm-9">--}}
                    {{--{{ $ticket->users->implode('name', ', ') }}--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4>Messages</h4>
                        </div>
                    </div>
                    @forelse(collect($ticket->messages)->sortByDesc('created_at') as $note)
                        <div class="row note-wrapper">
                            <div class="col-sm-12">
                                <div class="row note" data-title="{{ $note->message }}">
                                    <div class="col-sm-1">
                                        <img src="{{ isset($note->token->tokenable->image) ? $note->token->tokenable->image->thumbnail: '' }}" class="img-circle img-responsive">
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="row pull-left">
                                            <div class="col-sm-12">
                                                <b>{{ $note->token->tokenable->name }}</b>
                                            </div>
                                            <div class="col-sm-12">
                                                <p>{!! $note->message !!}</p>
                                            </div>
                                            <div class="col-sm-12">
                                                @foreach($note->images as $image)
                                                    <a href="{{ $image->url }}" target="_blank" class="file-url">
                                                        {{--<i class="fa fa-file fa-2x"></i>--}}
                                                        <img src="{{ $image->thumbnail }}" height="150" width="200" class="img-responsive">
                                                        {{--                                                        <span>{{ $image->name }}</span>--}}
                                                    </a>
                                                @endforeach
                                            </div>
                                            <div class="col-sm-12">
                                                <p>{!! $note->created_at ? $note->created_at : '-' !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        No Notes
                    @endforelse
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('admin.support.message.create', $ticket->slug) }}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                        <i class="material-icons">add</i>
                        Post Message
                    </a>
                </div>
            </div>
        </div>
    @endcomponent
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.btn-delete').click(function () {
                if (confirm('Are you sure?'))
                    $(this).closest('li').find('form').submit()
            });
        });
    </script>
@endpush