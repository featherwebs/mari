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
                'title'  => 'Other',
                'slug'   => 'other',
                'custom' => '[]',
                'alias'  => '[]'
            ]

        ];

        PostType::insert($postTypes);
    }
}
