@extends('featherwebs::admin.layout')

@section('title', 'Support')

@section('content')
    @component('featherwebs::admin.template.default')
        @slot('heading')
            <h2 class="mdl-card__title-text">Support</h2>
        @endslot
        @slot('tools')
            <a href="{{ route('admin.support.create') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                <i class="material-icons">add</i>
                Add
            </a>
        @endslot
        @slot('breadcrumb')
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Support</li>
                </ol>
            </nav>
        @endslot
        <div>
            <div class="panel">
                <table id="ticket-datatable" class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tickets as $ticket)
                        @php
                            switch (strtolower($ticket->status)) {
                            case "open";
                                $class="info";
                                break;
                            case "closed";
                                $class="default";
                                break;
                            case "resolved";
                                $class="success";
                                break;
                            case "rejected";
                                $class="warning";
                                break;
                            default;
                                $class="active";
                            }
                        @endphp
                        <tr>
                            <td>{{ $ticket->slug }}</td>
                            <td>{{ $ticket->title }}</td>
                            <td class="text-center {{ $class }}">{!! $ticket->status !!}</td>
                            <td>
                                <a href="{{ route('admin.support.show', $ticket->slug) }}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">View</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endcomponent
@endsection

@push('styles')
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.material.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.material.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#ticket-datatable').DataTable();
        });
    </script>
@endpush