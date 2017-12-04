@extends('layouts.app')

@section('content')
    @component('layouts.admin-template')
        @slot('heading')
            Users
            <div class="pull-right">
                <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-xs">
                    <i class="fa fa-plus"></i>
                    Add
                </a>
            </div>
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
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-1">ID</div>
                        <div class="col-xs-3">Name</div>
                        <div class="col-xs-2">Role</div>
                        <div class="col-xs-3">Email</div>
                        <div class="col-xs-1">Active</div>
                        <div class="col-xs-2">Actions</div>
                    </div>
                </div>
            </div>
            @foreach($users as $user)
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-1">{{ $user->id }}</div>
                            <div class="col-xs-3">
                                {{ $user->name }}
                            </div>
                            <div class="col-xs-2">{{ $user->roles->implode('display_name',', ') }}</div>
                            <div class="col-xs-3">{{ $user->email }}</div>
                            <div class="col-xs-1">
                                @if($user->is_active)
                                    <i class="fa fa-check-circle-o text-success"></i>
                                @else
                                    <i class="fa fa-times text-muted"></i>
                                @endif
                            </div>
                            <div class="col-xs-2 text-right">
                                <form method="POST" action="{{ route('admin.user.destroy', $user->username) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a href="{{ route('admin.user.edit', $user->username) }}" class="btn btn-xs btn-primary">
                                        Edit
                                    </a>
                                    <button onclick="return confirm('Are You sure?');" class="btn btn-xs btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endcomponent
@endsection