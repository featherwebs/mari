@extends('layouts.app')

@section('content')
    @component('layouts.admin-template')
        @slot('heading')
            Dashboard
        @endslot
        <div class="well well-home">
            <div class="row">
                <div class="col-md-7">
                    <h2>Hi <strong>{{ auth()->user()->name }}!</strong></h2>
                    <p>Welcome back to the {{ env('APP_NAME') }} control panel.</p>
                    <p>Click on the pages menu item to start editing page specific content, or for content on more than one page go to site-wide content.</p>
                </div>
                <div class="col-md-5 text-center">
                    <a href="{{ route('admin.setting.index') }}" class="btn btn-default" style="margin-top:30px;">
                        <i class="fa fa-lock"></i> Account settings
                    </a>
                    <a href="#" class="btn btn-default" style="margin-top:30px;">
                        <i class="fa fa-life-ring"></i> Help Docs
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            @role('admin')
                <div class="col-sm-12">
                <div class="well well-home">
                    <h3><i class="fa fa-pencil" aria-hidden="true"></i> Recent Activities</h3>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>Resource</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($activities as $activity)
                            <tr>
                                <td>{{ $activity->id }}</td>
                                <td>{{ $activity->userResponsible() ? $activity->userResponsible()->name: 'Unknown' }}</td>
                                <td>
                                    @if($activity->key == 'created_at' && !$activity->old_value)
                                        Created this resource
                                    @else
                                        Changed {{ $activity->fieldName() }} from {{ $activity->oldValue() }} to {{ $activity->newValue() }}
                                    @endif
                                </td>
                                <td>{{ $activity->revisionable ? str_limit($activity->revisionable->title,25) : '' }}
                                    <b>{{(new \ReflectionClass($activity->revisionable_type))->getShortName()."[ID:".$activity->revisionable_id."]"}}</b>
                                </td>
                                <td>{{ $activity->created_at->format('g:i A j/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No Activities</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <p>
                        <a class="btn btn-default" href="http://demo.coastercms.org/admin/home/logs">View all admin logs</a>
                    </p>
                </div>
            </div>
            @endrole
        </div>
    @endcomponent
@endsection
