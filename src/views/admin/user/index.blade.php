@extends('featherwebs::admin.layout')

@section('title', 'Users')

@section('content')
    @component('featherwebs::admin.template.default')
        @slot('heading')
            <h2 class="mdl-card__title-text">User</h2>
        @endslot
        @slot('tools')
            <a href="{{ route('admin.user.create') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                <i class="material-icons">add</i>
                Add
            </a>
        @endslot
        @slot('breadcrumb')
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User</li>
                </ol>
            </nav>
        @endslot
        <div>
            <div class="panel">
                <table id="user-datatable" class="mdl-data-table" width="100%">
                    <thead>
                        <tr>
                            <th class="col-xs-1">ID</th>
                            <th class="col-xs-3">Name</th>
                            <th class="col-xs-2">Role</th>
                            <th class="col-xs-3">Email</th>
                            <th class="col-xs-1">Active</th>
                            <th class="col-xs-2">Actions</th>
                        </tr>
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
            $('#user-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    type: 'POST',
                    url: '/api/user',
                    data: { _token: $('meta[name="csrf-token"]').attr('content') }
                },
                columns:[
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'roles', name: 'roles.name', render:function (data) {
                        return data.map(function(elem){
                            return elem.display_name;
                        }).join(", ");
                    }},
                    {data: 'email', name: 'email'},
                    {data: 'is_active', name: 'is_active', render:function(data){
                        if(data)
                            return "<i class='material-icons text-success'>check_circle</i>";
                        else
                            return "<i class='fa fa-times text-muted'></i>";
                    }},
                    {data: 'username',name: 'username', searchable:false, orderable:false, render: function(data,meta,row){
                        var actions = '<form method="POST" action="/admin/user/'+ data +'">';
                        actions += '<input type="hidden" name="_method" value="DELETE">';
                        actions += '<input type="hidden" name="_token" value="'+$('[name=csrf-token]').attr('content')+'">';

                        actions += '<a href="/admin/user/' + data +'/edit" class="mdl-button mdl-js-button" title="Edit"><i class="material-icons">edit</i></a>';

                        actions += '<button onclick="return confirm(\'Are you sure?\')" class="mdl-button mdl-js-button mdl-color-text--red" title="Delete"><i class="material-icons">delete</i></button>';
                        actions += '</form>';

                        return actions;
                    }}

                ],
                columnDefs: [
                    {
                        targets: [ 0, 1, 2, 3, 4 ],
                        className: 'mdl-data-table__cell--non-numeric'
                    }
                ]
            });
        });
    </script>
@endpush