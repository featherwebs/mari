<?php

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
                'id'    => 1,
                'title' => 'Event',
                'slug'  => 'event'
            ],
            [
                'id'    => 2,
                'title' => 'News',
                'slug'  => 'news'
            ],
            [
                'id'    => 3,
                'title' => 'Other',
                'slug'  => 'other'
            ]

        ];

        PostType::insert($postTypes);
    }
}
