@extends('featherwebs::admin.layout')

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
            <div class="panel">
                <table id="menu-datatable">
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
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
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
                    {data: 'title', name: 'title'},
                    {data:'sub_menus', name: 'subMenus', render: function(data){
                        return data.length;
                    }},
                    {data: 'slug', name: 'slug'},
                    {data: 'slug',name: 'slug', searchable:false, orderable:false, render: function(data,meta,row){
                        var actions = '<form method="POST" action="/admin/menu/'+ data +'">';
                        actions += '<input type="hidden" name="_method" value="DELETE">';
                        actions += '<input type="hidden" name="_token" value="'+$('[name=csrf-token]').attr('content')+'">';
                        actions += '<a href="/admin/menu/' + data +'" class="btn btn-primary btn-xs" target="_blank">Submenus</a>';
                        actions += '<a href="/admin/menu/' + data +'/edit" class="btn btn-primary btn-xs">Edit</a>';
                        actions += '<button onclick="return confirm(\'Are you sure?\')" class="btn btn-danger btn-xs">Delete</button>';
                        actions += '</form>';

                        return actions;
                    }}

                ]
            });
        });
    </script>
@endpush