@extends('featherwebs::admin.layout')

@section('title', str_plural($postType->title))

@section('content')
    @component('featherwebs::admin.template.default')
        @slot('heading')
            <h2 class="mdl-card__title-text">{{ str_plural($postType->title) }}</h2>
        @endslot
        @slot('tools')
            @permission('create-post')
            <a href="{{ route('admin.post.create', $postType->slug) }}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                <i class="material-icons">add</i> ADD
            </a>
            @endpermission
        @endslot
        @slot('breadcrumb')
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ str_plural($postType->title) }}</li>
                </ol>
            </nav>
        @endslot
        <div>
            <div class="panel">
                <table id="page-datatable" class="mdl-data-table" width="100%">
                    <thead>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Published</th>
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
                    url: '/api/post',
                    data: { _token: $('meta[name="csrf-token"]').attr('content'), 'post_type': '{{ $postType->slug }}' }
                },
                columns:[
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title', render:function (data,meta,row) {
                        @permission('update-post')
                            return "<a href='/admin/post/"+row.slug+"/edit'>"+data+"</a>";
                        @endpermission
                        return data;
                    }},
                    {data: 'is_published', name: 'is_published', render:function(data){
                        if(data)
                            return "<i class='material-icons text-success'>check_circle</i>";
                        else
                            return "<i class='fa fa-times text-muted'></i>";
                    }},
                    {data: 'slug',name: 'slug', searchable:false, orderable:false, render: function(data,meta,row){
                        var actions = '<form method="POST" action="/admin/post/'+ data +'">';
                        actions += '<input type="hidden" name="_method" value="DELETE">';
                        actions += '<input type="hidden" name="_token" value="'+$('[name=csrf-token]').attr('content')+'">';
                        @permission('update-post')
                        actions += '<a href="/admin/post/' + data +'/edit" class="mdl-button mdl-js-button" title="Edit"><i class="material-icons">edit</i></a>';
                        @endpermission
                        @permission('delete-post')
                        actions += '<button onclick="return confirm(\'Are you sure?\')" class="mdl-button mdl-js-button mdl-color-text--red" title="Delete"><i class="material-icons">delete</i></button>';
                        @endpermission
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