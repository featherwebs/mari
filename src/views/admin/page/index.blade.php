@extends('featherwebs::admin.layout')

@section('title', 'Pages')

@section('content')
    @component('featherwebs::admin.template.default')
        @slot('heading')
            <h2 class="mdl-card__title-text">Pages</h2>
        @endslot
        @slot('tools')
            <a href="{{ route('admin.page.create') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                <i class="material-icons">add</i> ADD
            </a>
        @endslot
        @slot('breadcrumb')
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Page</li>
                </ol>
            </nav>
        @endslot
        <div>
            <table id="page-datatable" class="mdl-data-table" width="100%">
                <thead>
                <th>SN</th>
                <th>Title</th>
                <th>Published</th>
                <th>Action</th>
                </thead>
                <tbody>
                </tbody>
            </table>
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
            var home_page_id = "{{ fw_setting('homepage') }}";
            $('#page-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    type: 'POST',
                    url: '/api/page',
                    data: { _token: $('meta[name="csrf-token"]').attr('content') }
                },
                columns:[
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title', render:function(data, meta, row){
                    @permission('update-page')
                        data = "<a href='/admin/page/"+row.slug+"/edit'>"+data+"</a>";
                    @endpermission
                        if(row.id == home_page_id)
                            return '<b>' + data + ' --Homepage-- </b>';
                        else
                            return '<b>' + data + '</b>';
                    }},
                    {data: 'is_published', name: 'is_published', render:function(data){
                        if(data)
                            return "<i class='material-icons text-success'>check_circle</i>";
                        else
                            return "<i class='fa fa-times text-muted'></i>";
                    }},
                    {data: 'slug',name: 'slug', searchable:false, orderable:false, render: function(data,meta,row){
                        var actions = '<form method="POST" action="/admin/page/'+ data +'">';
                        actions += '<input type="hidden" name="_method" value="DELETE">';
                        actions += '<input type="hidden" name="_token" value="'+$('[name=csrf-token]').attr('content')+'">';

                        if(row.id == home_page_id)
                            actions += '<a href="/" class="mdl-button mdl-js-button" target="_blank"><i class="material-icons">launch</i></a>';
                        else
                            actions += '<a href="/' + data +'" class="mdl-button mdl-js-button" target="_blank"><i class="material-icons">launch</i></a>';

                        actions += '<a href="/admin/page/' + data +'/edit" class="mdl-button mdl-js-button"><i class="material-icons">edit</i></a>';

                        if(row.id != home_page_id)
                            actions += '<button onclick="return confirm(\'Are you sure?\')" class="mdl-button mdl-js-button mdl-color-text--red"><i class="material-icons">delete</i></button>';
                        actions += '</form>';

                        return actions;
                    }}

                ],
                columnDefs: [
                    {
                        targets: [ 0, 1, 2 ],
                        className: 'mdl-data-table__cell--non-numeric'
                    }
                ]
            });
        });
    </script>
@endpush
