@extends('featherwebs::admin.layout')

@section('title', 'Menus')

@section('content')
    <div id="menu-app">
        @component('featherwebs::admin.template.default')
            @slot('heading')
                <h2 class="mdl-card__title-text">Menu</h2>
            @endslot

            @slot('tools')
                @permission('create-post')
                <a href="{{ route('admin.menu.create') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                    <i class="material-icons">add</i> ADD
                </a>
                @endpermission
            @endslot

            @slot('breadcrumb')
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Menu</li>
                    </ol>
                </nav>
            @endslot

            @component('featherwebs::admin.template.alert', ['type' => 'info'])
                How To Use:
                You can output this menu anywhere on your site by calling <code>fw_menu('slug')</code>
            @endcomponent

            <div class="panel">
                <table id="menu-datatable" class="mdl-data-table" width="100%">
                    <thead>
                    <th>SN</th>
                    <th>Title</th>
                    <th>Sub Menus</th>
                    <th>Slug</th>
                    <th>Action</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        @endcomponent
    </div>
@endsection

@push('styles')
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.material.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.material.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#menu-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    type: 'POST',
                    url: '/api/menu',
                    data: { _token: $('meta[name="csrf-token"]').attr('content') }
                },
                columns:[
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title', render:function (data,meta,row) {
                        @permission('update-menu')
                        return "<a href='/admin/menu/"+row.slug+"/edit'>"+data+"</a>";
                        @endpermission
                        return data;
                    }},
                    {data:'sub_menus', name: 'subMenus', render: function(data){
                        return data.length;
                    }},
                    {data: 'slug', name: 'slug'},
                    {data: 'slug',name: 'slug', searchable:false, orderable:false, render: function(data,meta,row){
                        var actions = '<form method="POST" action="/admin/menu/'+ data +'">';
                        actions += '<input type="hidden" name="_method" value="DELETE">';
                        actions += '<input type="hidden" name="_token" value="'+$('[name=csrf-token]').attr('content')+'">';
                        @permission('update-menu')
                        actions += '<a href="/admin/menu/' + data +'/edit" class="mdl-button mdl-js-button"><i class="material-icons">edit</i></a>';
                        @endpermission
                        actions += '<button onclick="return confirm(\'Are you sure?\')" class="mdl-button mdl-js-button mdl-color-text--red"><i class="material-icons">delete</i></button>';
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