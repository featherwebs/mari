<?php

namespace Featherwebs\Mari\Seeder;

use Featherwebs\Mari\Models\Permission;
use Featherwebs\Mari\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Role::firstOrCreate([
            'name' => 'super-admin'
        ]);
        $superAdmin->update([
            'description'  => 'super-admin',
            'display_name' => 'Super Administrator'
        ]);


        $admin = Role::firstOrCreate([
            'name' => 'admin'
        ]);
        $admin->update([
            'description'  => 'admin',
            'display_name' => 'Administrator'
        ]);


        $editor = Role::firstOrCreate([
            'name' => 'editor'
        ]);
        $editor->update([
            'display_name' => 'Editor'
        ]);

        $createRole = Permission::firstOrCreate([
            'name'         => 'create-role',
            'display_name' => 'Create Roles',
            'description'  => 'Roles'
        ]);
        $readRole   = Permission::firstOrCreate([
            'name'         => 'read-role',
            'display_name' => 'Read Roles',
            'description'  => 'Roles'
        ]);
        $updateRole = Permission::firstOrCreate([
            'name'         => 'update-role',
            'display_name' => 'Update Roles',
            'description'  => 'Roles'
        ]);
        $deleteRole = Permission::firstOrCreate([
            'name'         => 'delete-role',
            'display_name' => 'Delete Roles',
            'description'  => 'Roles'
        ]);

        $createPost = Permission::firstOrCreate([
            'name'         => 'create-post',
            'display_name' => 'Create Posts',
            'description'  => 'Posts'
        ]);
        $readPost   = Permission::firstOrCreate([
            'name'         => 'read-post',
            'display_name' => 'Read Posts',
            'description'  => 'Posts'
        ]);
        $updatePost = Permission::firstOrCreate([
            'name'         => 'update-post',
            'display_name' => 'Update Posts',
            'description'  => 'Posts'
        ]);
        $deletePost = Permission::firstOrCreate([
            'name'         => 'delete-post',
            'display_name' => 'Delete Posts',
            'description'  => 'Posts'
        ]);

        $createMedia = Permission::firstOrCreate([
            'name'         => 'create-media',
            'display_name' => 'Create Medias',
            'description'  => 'Medias'
        ]);
        $readMedia   = Permission::firstOrCreate([
            'name'         => 'read-media',
            'display_name' => 'Read Medias',
            'description'  => 'Medias'
        ]);
        $updateMedia = Permission::firstOrCreate([
            'name'         => 'update-media',
            'display_name' => 'Update Medias',
            'description'  => 'Medias'
        ]);
        $deleteMedia = Permission::firstOrCreate([
            'name'         => 'delete-media',
            'display_name' => 'Delete Medias',
            'description'  => 'Medias'
        ]);

        $createPage = Permission::firstOrCreate([
            'name'         => 'create-page',
            'display_name' => 'Create Pages',
            'description'  => 'Pages'
        ]);
        $readPage   = Permission::firstOrCreate([
            'name'         => 'read-page',
            'display_name' => 'Read Pages',
            'description'  => 'Pages'
        ]);
        $updatePage = Permission::firstOrCreate([
            'name'         => 'update-page',
            'display_name' => 'Update Pages',
            'description'  => 'Pages'
        ]);
        $deletePage = Permission::firstOrCreate([
            'name'         => 'delete-page',
            'display_name' => 'Delete Pages',
            'description'  => 'Pages'
        ]);

        $createMenu = Permission::firstOrCreate([
            'name'         => 'create-menu',
            'display_name' => 'Create Menus',
            'description'  => 'Menus'
        ]);
        $readMenu   = Permission::firstOrCreate([
            'name'         => 'read-menu',
            'display_name' => 'Read Menus',
            'description'  => 'Menus'
        ]);
        $updateMenu = Permission::firstOrCreate([
            'name'         => 'update-menu',
            'display_name' => 'Update Menus',
            'description'  => 'Menus'
        ]);
        $deleteMenu = Permission::firstOrCreate([
            'name'         => 'delete-menu',
            'display_name' => 'Delete Menus',
            'description'  => 'Menus'
        ]);

        $createUser = Permission::firstOrCreate([
            'name'         => 'create-user',
            'display_name' => 'Create Users',
            'description'  => 'Users'
        ]);
        $readUser   = Permission::firstOrCreate([
            'name'         => 'read-user',
            'display_name' => 'Read Users',
            'description'  => 'Users'
        ]);
        $updateUser = Permission::firstOrCreate([
            'name'         => 'update-user',
            'display_name' => 'Update Users',
            'description'  => 'Users'
        ]);
        $deleteUser = Permission::firstOrCreate([
            'name'         => 'delete-user',
            'display_name' => 'Delete Users',
            'description'  => 'Users'
        ]);

        $createSetting = Permission::firstOrCreate([
            'name'         => 'create-setting',
            'display_name' => 'Create Settings',
            'description'  => 'Settings'
        ]);
        $readSetting   = Permission::firstOrCreate([
            'name'         => 'read-setting',
            'display_name' => 'Read Settings',
            'description'  => 'Settings'
        ]);
        $updateSetting = Permission::firstOrCreate([
            'name'         => 'update-setting',
            'display_name' => 'Update Settings',
            'description'  => 'Settings'
        ]);
        $deleteSetting = Permission::firstOrCreate([
            'name'         => 'delete-setting',
            'display_name' => 'Delete Settings',
            'description'  => 'Settings'
        ]);

        $createPostType = Permission::firstOrCreate([
            'name'         => 'create-post-type',
            'display_name' => 'Create Post Type',
            'description'  => 'Post Types'
        ]);
        $readPostType   = Permission::firstOrCreate([
            'name'         => 'read-post-type',
            'display_name' => 'Read Post Types',
            'description'  => 'Post Types'
        ]);
        $updatePostType = Permission::firstOrCreate([
            'name'         => 'update-post-type',
            'display_name' => 'Update Post Types',
            'description'  => 'Post Types'
        ]);
        $deletePostType = Permission::firstOrCreate([
            'name'         => 'delete-post-type',
            'display_name' => 'Delete Post Types',
            'description'  => 'Post Types'
        ]);

        $superAdmin->attachPermissions([
            $createRole,
            $readRole,
            $updateRole,
            $deleteRole,
            $createPost,
            $readPost,
            $updatePost,
            $deletePost,
            $createMedia,
            $readMedia,
            $updateMedia,
            $deleteMedia,
            $createPage,
            $readPage,
            $updatePage,
            $deletePage,
            $createMenu,
            $readMenu,
            $updateMenu,
            $deleteMenu,
            $createUser,
            $readUser,
            $updateUser,
            $deleteUser,
            $createSetting,
            $readSetting,
            $updateSetting,
            $deleteSetting,
            $createPostType,
            $readPostType,
            $updatePostType,
            $deletePostType
        ]);

        $admin->attachPermissions([
            $createPost,
            $readPost,
            $updatePost,
            $deletePost,
            $createMedia,
            $readMedia,
            $updateMedia,
            $deleteMedia,
            $createPage,
            $readPage,
            $updatePage,
            $deletePage,
            $createMenu,
            $readMenu,
            $updateMenu,
            $deleteMenu,
            $createUser,
            $readUser,
            $updateUser,
            $deleteUser,
            $createSetting,
            $readSetting,
            $updateSetting,
            $deleteSetting,
        ]);

        $editor->attachPermissions([
            $createPost,
            $readPost,
            $updatePost,
            $createMedia,
            $readMedia,
            $updateMedia,
            $createPage,
            $readPage,
            $updatePage,
            $createMenu,
            $readMenu,
            $updateMenu,
        ]);
    }
}
