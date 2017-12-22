@extends('featherwebs::admin.layout')

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
            <table id="page-datatable">
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
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">--}}
@endpush
@push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
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
                            actions += '<a href="/" class="btn btn-default btn-xs" target="_blank">View</a>';
                        else
                            actions += '<a href="/' + data +'" class="btn btn-default btn-xs" target="_blank">View</a>';

                        actions += '<a href="/admin/page/' + data +'/edit" class="btn btn-default btn-xs">Edit</a>';

                        if(row.id != home_page_id)
                            actions += '<button onclick="return confirm(\'Are you sure?\')" class="btn btn-danger btn-xs">Delete</button>';
                        actions += '</form>';

                        return actions;
                    }}

                ]
            });
        });
    </script>
@endpush