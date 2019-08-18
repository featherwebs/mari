<?php

namespace Featherwebs\Mari\Seeder;

use Illuminate\Database\Seeder;
use Featherwebs\Mari\Models\Page;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = [
            'slug'             => 'home',
            'title'            => 'Home',
            'sub_title'        => '',
            'meta_title'       => '',
            'meta_description' => '',
            'meta_keywords'    => '',
            'custom'           => [],
            'view'             => 'home',
            'is_published'     => 1,
            'page_id'          => null,
        ];

        Page::create($page);
        $page->lb_content = "";
    }
}
