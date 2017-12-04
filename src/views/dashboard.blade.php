@extends('layouts.app')

@section('content')
    @component('layouts.admin-template')
        @slot('heading')
            Dashboard
        @endslot
        <!-- dashboard-welcome starts-->
        <div class="well well-home dashboard-welcome rounded-border-well table-shadow">
            <div class="row">
                <div class="col-md-7">
                    <h2 class="dashboard-welcome-greeting">Hi <strong>{{ auth()->user()->name }}!</strong></h2>
                    <p>Welcome back to the {{ env('APP_NAME') }} control panel.</p>
                    <p>Click on the pages menu item to start editing page specific content, or for content on more than one page go to site-wide content.</p>
                </div>
                <div class="col-md-5 text-center">
                    <a href="{{ route('admin.setting.index') }}" class="btn btn-default rounded-border-btn" style="margin-top:30px;">
                        <i class="fa fa-lock"></i> Account settings
                    </a>
                    <a href="#" class="btn btn-default rounded-border-btn shadow-effect" style="margin-top:30px;">
                        <i class="fa fa-life-ring"></i> Help Docs
                    </a>
                </div>
            </div>
        </div>
        <!-- dashboard-welcome ends-->
        <!--dashboard-table starts  -->
        <div class="row">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="well well-home rounded-border-well table-shadow">
                            <h3><i class="fa fa-pencil" aria-hidden="true"></i> Recent Activities</h3>
                            <table class="table table-hover">
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
                                        <td class="fix-action-width">
                                            @if($activity->key == 'created_at' && !$activity->old_value)
                                                Created this resource
                                            @else
                                                Changed {{ $activity->fieldName() }} from {{ str_limit($activity->oldValue(), 50) }} to {{ str_limit($activity->newValue(), 50) }}
                                            @endif
                                        </td>
                                        <td>{{ $activity->revisionable ? str_limit($activity->revisionable->title,25) : '' }}
{{--                                            <b>{{explode('\\',$activity->revisionable_type)[2]."[ID:".$activity->revisionable_id."]"}}</b>--}}
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

                        </div>
                    </div>
                </div>
                <a class="btn btn-default rounded-border-btn pull-right fix-margin-bottom shadow-effect" href="http://demo.coastercms.org/admin/home/logs">View all admin logs</a>
            </div>
            <div class="col-md-2">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="dash-side-tablets dash-side-tablets-1 shadow-effect">
                            1
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="dash-side-tablets dash-side-tablets-2 shadow-effect">
                            1
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="dash-side-tablets dash-side-tablets-3 shadow-effect">
                            1
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!--dashboard-table ends  -->


    @endcomponent
@endsection
