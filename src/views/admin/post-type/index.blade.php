@extends('featherwebs::admin.layout')

@section('title', 'Post Types')

@section('content')
    @component('featherwebs::admin.template.default')
        @slot('heading')
            <h2 class="mdl-card__title-text">Post Types</h2>
        @endslot
        @slot('tools')
            @permission('create-post-type')
            <a href="{{ route('admin.post-type.create') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                <i class="material-icons">add</i> ADD
            </a>
            @endpermission
        @endslot
        @slot('breadcrumb')
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Post Type</li>
                </ol>
            </nav>
        @endslot
        <div>
            <div class="panel">
                <table id="page-datatable" class="mdl-data-table" width="100%">
                    <thead>
                    <th>SN</th>
                    <th>Display Name</th>
                    <th>Slug</th>
                    <th>Custom Fields</th>
                    <th>Action</th>
                    </thead>
                    <tbody>
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
        $(document).ready(function() {
            $('#page-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    type: 'POST',
                    url: '/api/post-type',
                    data: { _token: $('meta[name="csrf-token"]').attr('content') }
                },
                columns:[
                    {data: 'id', name: 'id'},
                    {data: 'title', name:'title'},
                    {data: 'slug', name: 'slug'},
                    {data: 'custom', name: 'custom', render: function(data){
                        return data ? data.map(function(custom){
                            return custom.title;
                        }).join(', '): '-';
                    }},
                    {data: 'slug',name: 'slug', searchable:false, orderable:false, render: function(data,meta,row){
                        var actions = '<form method="POST" action="/admin/post-type/'+ data +'">';
                        actions += '<input type="hidden" name="_method" value="DELETE">';
                        actions += '<input type="hidden" name="_token" value="'+$('[name=csrf-token]').attr('content')+'">';
                    @permission('update-post-type')
                        actions += '<a href="/admin/post-type/' + data +'/edit" class="mdl-button mdl-js-button"><i class="material-icons">edit</i></a>';
                    @endpermission
                    @permission('delete-post-type')
                        actions += '<button onclick="return confirm(\'Are you sure?\')" class="mdl-button mdl-js-button mdl-color-text--red"><i class="material-icons">delete</i></button>';
                    @endpermission
                        actions += '</form>';

                        return actions;
                    }}

                ],
                columnDefs: [
                    {
                        targets: [ 0, 1, 2, 3 ],
                        className: 'mdl-data-table__cell--non-numeric'
                    }
                ]
            });
        });
    </script>
@endpush