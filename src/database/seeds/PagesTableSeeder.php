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
        $data = [
            'slug'             => 'home',
            'title'            => 'Home',
            'sub_title'        => '',
            'meta_title'       => '',
            'meta_description' => '',
            'meta_keywords'    => '',
            'view'             => 'home',
            'is_published'     => 1,
            'page_id'          => null,
        ];

        $page = Page::create($data);
        $page->lb_content = "";
    }
}
