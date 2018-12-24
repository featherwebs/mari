@extends('featherwebs::admin.layout')

@section('title', 'Roles')

@section('content')
    @component('featherwebs::admin.template.default')
        @slot('heading')
            <h2 class="mdl-card__title-text">Roles</h2>
        @endslot
        @slot('tools')
            @permission('create-role')
            <a href="{{ route('admin.role.create') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                <i class="material-icons">add</i> ADD
            </a>
            @endpermission
        @endslot
        @slot('breadcrumb')
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Role</li>
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
                    url: '/api/role',
                    data: { _token: $('meta[name="csrf-token"]').attr('content') }
                },
                columns:[
                    {data: 'id', name: 'id'},
                    {data: 'display_name', name:'display_name'},
                    {data: 'name', name: 'name'},
                    {data: 'name',name: 'name', searchable:false, orderable:false, render: function(data,meta,row){
                        var actions = '<form method="POST" action="/admin/role/'+ data +'">';
                        actions += '<input type="hidden" name="_method" value="DELETE">';
                        actions += '<input type="hidden" name="_token" value="'+$('[name=csrf-token]').attr('content')+'">';
                        @permission('update-role')
                        actions += '<a href="/admin/role/' + data +'/edit" class="mdl-button mdl-js-button"><i class="material-icons">edit</i></a>';
                        @endpermission
                        @permission('delete-role')
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