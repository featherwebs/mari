<div id="user-app" v-cloak>
    @isset($profile)
        <input type="hidden" name="user[profile]" value="1">
    @endisset
    <input type="hidden" name="user[id]" :value="user.id" v-if="user.id">
    <div class="row">
        <div class="col-sm-9">
            <div class="form-group">
                <label for="name" class="control-label col-sm-2">Name</label>
                <div class="col-sm-10">
                    <input class="form-control" name="user[name]" type="text" id="name" v-model="user.name">
                    <span class="help-block">Min 3 characters</span>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="control-label col-sm-2">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="user[email]" id="email" v-model="user.email">
                    <span class="help-block">Unique Email</span>
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="control-label col-sm-2">Username</label>
                <div class="col-sm-10">
                    <input class="form-control" name="user[username]" id="username" v-model="user.username" autocomplete="off">
                    <span class="help-block">Unique Username</span>
                </div>
            </div>
            <div class="form-group" v-if="user.id">
                <label for="changePassword" class="control-label col-sm-2">Change Password</label>
                <div class="col-sm-10">
                    <input id="changePassword" v-model="changePassword" type="checkbox" :value="true">
                    <span class="help-block">Select to change password</span>
                </div>
            </div>
            <template v-if="!user.id || changePassword">
                <div class="form-group">
                    <label for="password" class="control-label col-sm-2">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="user[password]" id="password" autocomplete="off">
                        <span class="help-block">Min 6 characters.</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="control-label col-sm-2">Password Confirmation</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="user[password_confirmation]" id="password_confirmation">
                        <span class="help-block">Repeat above password.</span>
                    </div>
                </div>
            </template>
            <div class="form-group" v-if="roles">
                <label for="roles" class="control-label col-sm-2">Role</label>
                <div class="col-sm-10">
                    <select class="form-control" name="user[role][id]" id="roles" v-model="user.role">
                        <option v-for="role in roles" :value="role.id" v-html="role.display_name"></option>
                    </select>
                    <span class="help-block">User Role</span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Active</label>
                <div class="col-sm-10">
                    <label>
                        <input type="radio" name="user[is_active]" :value="1" v-model="user.is_active">
                        Yes
                    </label>
                    <label>
                        <input type="radio" name="user[is_active]" id="is_active" :value="0" v-model="user.is_active">
                        No
                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <label for="image">
                <image-selector name="user[image]" :value="user.image && user.image.url ? user.image && user.image.url: null" />
            </label>
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.min.js"></script>
    <script src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/vendor/laravel-filemanager/js/lfm.js') }}"></script>
    <script>
                @if($user = old('user', isset($user) ? $user : null))
        var user = JSON.parse('{!! addslashes(json_encode($user)) !!}');
                @endif

                @if(isset($roles))
        var rolesArr = JSON.parse('{!! addslashes(json_encode($roles)) !!}');
        @endif
    </script>

    <script type="text/javascript">
        @php
            include base_path().'/vendor/featherwebs/mari/src/public/js/dist/user.js';
        @endphp
    </script>
@endpush