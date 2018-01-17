@extends('featherwebs::admin.layout')

@section('content')
    @component('featherwebs::admin.template.default')
        @slot('heading')
            <h2 class="mdl-card__title-text">Pages</h2>
        @endslot
        @slot('tools')
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="button" data-toggle="modal" data-target="#addModal">
                <i class="fa fa-plus"></i>
                Add
            </button>
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
                <th>Action</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    @endcomponent

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="AddModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <form id='create-gallery' enctype="multipart/form-data" method="POST" action="{{ route('admin.gallery.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-md-2 control-label">Title</label>
                            <div class="col-md-10">
                                <input class="form-control" type='text' name="title">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-primary btn-edit">Proceed to Edit</a>
{{--                    <a href="{{ route('admin.media.index') }}" class="btn btn-default">Done</a>--}}
                </div>
            </div>
        </div>
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
            var home_page_id = "{{ fw_setting('homepage') }}";
            $('#page-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    type: 'POST',
                    url: '/api/gallery',
                    data: { _token: $('meta[name="csrf-token"]').attr('content') }
                },
                columns:[
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},

                    {data: 'slug',name: 'slug', searchable:false, orderable:false, render: function(data,meta,row){
                            var actions = '<form method="POST" action="/admin/page/'+ data +'">';
                            actions += '<input type="hidden" name="_method" value="DELETE">';
                            actions += '<input type="hidden" name="_token" value="'+$('[name=csrf-token]').attr('content')+'">';


                            actions += '<a href="/' + data +'" class="mdl-button mdl-js-button" target="_blank"><i class="material-icons">launch</i></a>';

                            actions += '<a href="/admin/gallery/' + data +'/edit" class="mdl-button mdl-js-button"><i class="material-icons">edit</i></a>';

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

        $('.btn-edit').click(function () {
            $('#create-gallery').submit();
        });
    </script>
@endpush
