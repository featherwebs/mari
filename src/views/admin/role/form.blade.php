<div id="role-app" v-cloak>
    <div class="form-group">
        <label for="title" class="control-label col-sm-2">Name</label>
        <div class="col-sm-10">
            <input class="form-control" name="name" type="text" v-model="role.display_name" id="name">
            <span class="help-block">Role Name</span>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>
                    Entities
                </th>
                <th>
                    Create
                </th>
                <th>
                    Read
                </th>
                <th>
                    Update
                </th>
                <th>
                    Delete
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="form-group" v-for="(group,name) in permissions">
                <td>@{{ name }}</td>
                <td v-for="permission in group">
                    <label class="mdl-switch mdl-js-switch" :for="'permission-'+permission.id">
                        <input type="checkbox" :id="'permission-'+permission.id" class="mdl-switch__input" :name="'permission['+permission.id+']'" :checked="role.perms.length && role.perms.filter(p=>p.id == permission.id).length">
                        <span class="mdl-switch__label"></span>
                    </label>
                </td>
            </tr>
        </tbody>
    </table>
</div>

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
@endpush

@push('scripts')
    <script>
                @if(isset($role))
        let role = JSON.parse('{!! addslashes(json_encode($role)) !!}');
                @endif

                @if(isset($permissions))
        let permissions = JSON.parse('{!! addslashes(json_encode($permissions->groupBy('description'))) !!}');
        @endif

        {{--@if($p = old('role', isset($role)?$role:null))--}}
        {{--let role = JSON.parse('{!! addslashes(json_encode($p)) !!}');--}}
        {{--@endif--}}
    </script>

    <script type="text/javascript">
        @php
            include base_path().'/vendor/featherwebs/mari/src/public/js/dist/role.js';
        @endphp
    </script>
@endpush