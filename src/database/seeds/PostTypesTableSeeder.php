<?php

namespace Featherwebs\Mari\Seeder;

use Featherwebs\Mari\Models\PostType;
use Illuminate\Database\Seeder;

class PostTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $postTypes = [
            [
                'id'     => 1,
                'title'  => 'Event',
                'slug'   => 'event',
                'custom' => '[{"slug":"event_on","type":"date","title":"Event Date"}]',
                'alias'  => '[]'
            ],
            [
                'id'     => 2,
                'title'  => 'News',
                'slug'   => 'news',
                'custom' => '[]',
                'alias'  => '[]'
            ],
            [
                'id'     => 3,
                'title'  => 'Slider',
                'slug'   => 'slider',
                'custom' => '[{"pivot":{"slug":"photo"},"slug":"photo","type":"image","title":"Image","default":null}]',
                'alias'  => '[{"visible":"true","alias":"Title","slug":"title","title":"Title","required":"true","default":null},{"visible":"false","alias":"Slug","slug":"slug","title":"Slug","required":"false","default":null},{"visible":"true","alias":"Sub Title","slug":"sub_title","title":"Sub Title","required":"false","default":null},{"visible":"false","alias":"Content","slug":"content","title":"Content","required":"false","default":null},{"visible":"true","alias":"Is Published","slug":"is_published","title":"Is Published","required":"false","default":"true"},{"visible":"false","alias":"Is Featured","slug":"is_featured","title":"Is Featured","required":"false","default":null},{"visible":"false","alias":"Template","slug":"view","title":"Template","required":"false","default":null},{"visible":"false","alias":"Tags","slug":"tags","title":"Tags","required":"false","default":null},{"visible":"false","alias":"Meta","slug":"meta","title":"Meta","required":"false","default":null}]'
            ]
        ];

        PostType::insert($postTypes);
    }
}
