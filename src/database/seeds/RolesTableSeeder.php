<?php

use App\Models\Permission;
use App\Models\Role;
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

        $managePost               = new Permission();
        $managePost->name         = 'manage-post';
        $managePost->display_name = 'Manage Posts';
        $managePost->save();

        $manageMedia               = new Permission();
        $manageMedia->name         = 'manage-media';
        $manageMedia->display_name = 'Manage Media';
        $manageMedia->save();

        $managePage               = new Permission();
        $managePage->name         = 'manage-page';
        $managePage->display_name = 'Manage Pages';
        $managePage->save();

        $manageMenu               = new Permission();
        $manageMenu->name         = 'manage-menu';
        $manageMenu->display_name = 'Manage Menus';
        $manageMenu->save();

        $manageUser               = new Permission();
        $manageUser->name         = 'manage-user';
        $manageUser->display_name = 'Manage Users';
        $manageUser->save();

        $manageSetting               = new Permission();
        $manageSetting->name         = 'manage-setting';
        $manageSetting->display_name = 'Manage Settings';
        $manageSetting->save();

        $admin->attachPermissions([
            $managePost,
            $manageMedia,
            $managePage,
            $manageMenu,
            $manageUser,
            $manageSetting,
        ]);

        $editor->attachPermissions([
            $managePost,
            $manageMedia,
            $managePage,
            $manageMenu
        ]);
    }
}
