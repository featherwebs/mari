<div id="user-app" v-cloak>
    @isset($profile)
        <input type="hidden" name="profile" value="1">
    @endisset
    <div class="row">
        <div class="col-sm-9">
            <div class="form-group">
                <label for="name" class="control-label col-sm-2">Name</label>
                <div class="col-sm-10">
                    <input class="form-control" name="name" type="text" id="name" v-model="user.name">
                    <span class="help-block">Min 3 characters</span>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="control-label col-sm-2">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" id="email" v-model="user.email">
                    <span class="help-block">Unique Email</span>
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="control-label col-sm-2">Username</label>
                <div class="col-sm-10">
                    <input class="form-control" name="username" id="username" v-model="user.username" autocomplete="off">
                    <span class="help-block">Unique Username</span>
                </div>
            </div>
            <div class="form-group" v-if="user.created_at">
                <label for="changePassword" class="control-label col-sm-2">Change Password</label>
                <div class="col-sm-10">
                    <input id="changePassword" v-model="changePassword" type="checkbox" :value="true">
                    <span class="help-block">Select to change password</span>
                </div>
            </div>
            <template v-if="!user.created_at || changePassword">
                <div class="form-group">
                    <label for="password" class="control-label col-sm-2">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" id="password" autocomplete="off">
                        <span class="help-block">Min 6 characters.</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="control-label col-sm-2">Password Confirmation</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                        <span class="help-block">Repeat above password.</span>
                    </div>
                </div>
            </template>
            <div class="form-group">
                <label for="roles" class="control-label col-sm-2">Role</label>
                <div class="col-sm-10">
                    <select class="form-control" name="role[id]" id="roles">
                        <option v-for="role in roles" :value="role.id" v-html="role.display_name" :selected="user.roles && user.roles.filter(r => r.id == role.id).length"></option>
                    </select>
                    <span class="help-block">User Role</span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Active</label>
                <div class="col-sm-10">
                    <label>
                        <input type="radio" name="is_active" id="is_active" :value="true" v-model="user.is_active">
                        Yes
                    </label>
                    <label>
                        <input type="radio" name="is_active" id="is_active" :value="false" v-model="user.is_active">
                        No
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="image" class="control-label col-sm-2">Avatar</label>
                <div class="col-sm-10">
                    <input id="image" class="form-control" name="image" type="file" @change="showPreview($event)" accept="image/jpeg,image/png,image/bmp">
                    <span class="help-block"></span>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <label for="image">
                <img alt="User Avatar" :src="user.image && user.image.thumbnail ? user.image.thumbnail: 'http://via.placeholder.com/250x250'" class="img-responsive">
            </label>
        </div>
    </div>
</div>
@push('scripts')
    <script>
                @if(isset($user))
        let user = JSON.parse('{!! addslashes(json_encode($user)) !!}');
                @endif
        let roles = JSON.parse('{!! addslashes(json_encode($roles)) !!}');
    </script>
    <script src="{{ asset('js/user.js') }}"></script>
@endpush