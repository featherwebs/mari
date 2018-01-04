<?php

namespace Featherwebs\Mari\Seeder;

use Featherwebs\Mari\Models\Menu;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $menu = [
            'slug'  => 'home',
            'title' => 'Home',
        ];

        $submenus = [
            [
                'title' => 'Posts',
                'url'   => '/post',
                'order' => 1
            ]
        ];

        $menu = Menu::create($menu);

        $menu->subMenus()->insert($submenus);
    }
}
