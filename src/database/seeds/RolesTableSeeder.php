<?php

use Featherwebs\Mari\Models\Permission;
use Featherwebs\Mari\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $admin               = new Role();
        $admin->name         = 'admin';
        $admin->display_name = 'Administrator';
        $admin->save();

        $editor               = new Role();
        $editor->name         = 'editor';
        $editor->display_name = 'Editor';
        $editor->save();

        $createPost               = new Permission();
        $createPost->name         = 'create-post';
        $createPost->display_name = 'Create Posts';
        $createPost->save();
        $readPost               = new Permission();
        $readPost->name         = 'read-post';
        $readPost->display_name = 'Read Posts';
        $readPost->save();
        $updatePost               = new Permission();
        $updatePost->name         = 'update-post';
        $updatePost->display_name = 'Update Posts';
        $updatePost->save();
        $deletePost               = new Permission();
        $deletePost->name         = 'delete-post';
        $deletePost->display_name = 'Delete Posts';
        $deletePost->save();

        $createMedia               = new Permission();
        $createMedia->name         = 'create-media';
        $createMedia->display_name = 'Create Medias';
        $createMedia->save();
        $readMedia               = new Permission();
        $readMedia->name         = 'read-media';
        $readMedia->display_name = 'Read Medias';
        $readMedia->save();
        $updateMedia               = new Permission();
        $updateMedia->name         = 'update-media';
        $updateMedia->display_name = 'Update Medias';
        $updateMedia->save();
        $deleteMedia               = new Permission();
        $deleteMedia->name         = 'delete-media';
        $deleteMedia->display_name = 'Delete Medias';
        $deleteMedia->save();

        $createPage               = new Permission();
        $createPage->name         = 'create-page';
        $createPage->display_name = 'Create Pages';
        $createPage->save();
        $readPage               = new Permission();
        $readPage->name         = 'read-page';
        $readPage->display_name = 'Read Pages';
        $readPage->save();
        $updatePage               = new Permission();
        $updatePage->name         = 'update-page';
        $updatePage->display_name = 'Update Pages';
        $updatePage->save();
        $deletePage               = new Permission();
        $deletePage->name         = 'delete-page';
        $deletePage->display_name = 'Delete Pages';
        $deletePage->save();

        $createMenu               = new Permission();
        $createMenu->name         = 'create-menu';
        $createMenu->display_name = 'Create Menus';
        $createMenu->save();
        $readMenu               = new Permission();
        $readMenu->name         = 'read-menu';
        $readMenu->display_name = 'Read Menus';
        $readMenu->save();
        $updateMenu               = new Permission();
        $updateMenu->name         = 'update-menu';
        $updateMenu->display_name = 'Update Menus';
        $updateMenu->save();
        $deleteMenu               = new Permission();
        $deleteMenu->name         = 'delete-menu';
        $deleteMenu->display_name = 'Delete Menus';
        $deleteMenu->save();

        $createUser               = new Permission();
        $createUser->name         = 'create-user';
        $createUser->display_name = 'Create Users';
        $createUser->save();
        $readUser               = new Permission();
        $readUser->name         = 'read-user';
        $readUser->display_name = 'Read Users';
        $readUser->save();
        $updateUser               = new Permission();
        $updateUser->name         = 'update-user';
        $updateUser->display_name = 'Update Users';
        $updateUser->save();
        $deleteUser               = new Permission();
        $deleteUser->name         = 'delete-user';
        $deleteUser->display_name = 'Delete Users';
        $deleteUser->save();

        $createSetting               = new Permission();
        $createSetting->name         = 'create-setting';
        $createSetting->display_name = 'Create Settings';
        $createSetting->save();
        $readSetting               = new Permission();
        $readSetting->name         = 'read-setting';
        $readSetting->display_name = 'Read Settings';
        $readSetting->save();
        $updateSetting               = new Permission();
        $updateSetting->name         = 'update-setting';
        $updateSetting->display_name = 'Update Settings';
        $updateSetting->save();
        $deleteSetting               = new Permission();
        $deleteSetting->name         = 'delete-setting';
        $deleteSetting->display_name = 'Delete Settings';
        $deleteSetting->save();

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
